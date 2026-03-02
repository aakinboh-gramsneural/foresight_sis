<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAutoReply;
use App\Mail\ContactFormSubmission;

class ContactController extends Controller
{
    public function index()
    {
        $this->generateCaptcha();

        return view('pages.contact', [
            'contactInfo' => ContactInfo::orderBy('order')->get(),
        ]);
    }

    public function refreshCaptcha()
    {
        $this->generateCaptcha();

        return response()->json([
            'svg' => view('components.captcha-svg', [
                'question' => session('captcha_question'),
            ])->render(),
        ]);
    }

    private function generateCaptcha(): void
    {
        $operators = ['+', '-', 'x'];
        $operator = $operators[array_rand($operators)];

        match ($operator) {
            '+' => [$a, $b] = [rand(2, 15), rand(1, 15)],
            '-' => [$a, $b] = [rand(10, 20), rand(1, 9)],
            'x' => [$a, $b] = [rand(2, 9), rand(2, 6)],
        };

        $answer = match ($operator) {
            '+' => $a + $b,
            '-' => $a - $b,
            'x' => $a * $b,
        };

        session([
            'captcha_question' => "{$a} {$operator} {$b} = ?",
            'captcha_answer' => $answer,
        ]);
    }

    public function store(Request $request)
    {
        // CAPTCHA check first — this is user-facing and must give real feedback
        $captchaAnswer = session('captcha_answer');
        $captchaInput = $request->input('captcha');

        if (! $captchaAnswer || (int) $captchaInput !== (int) $captchaAnswer) {
            $this->generateCaptcha();
            return back()->withInput()->withErrors(['captcha' => 'Incorrect answer. Please try again.']);
        }

        // Silent bot checks — only run after CAPTCHA passes
        if ($request->filled('website') || $request->filled('phone_number')) {

            return back()->with('success', 'Thank you for your message. We will get back to you soon!');
        }

        $loadedAt = (int) $request->input('_form_loaded', 0);
        if ($loadedAt && (now()->timestamp - $loadedAt) < 3) {

            return back()->with('success', 'Thank you for your message. We will get back to you soon!');
        }

        if (! $request->filled('_js_token')) {
            
            return back()->with('success', 'Thank you for your message. We will get back to you soon!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        $submission = ContactSubmission::create($validated);

        try {
            Mail::to('admin@foresightcosec.com')->send(new ContactFormSubmission($submission));
            Mail::to($submission->email)->send(new ContactAutoReply($submission));
        } catch (\Exception $e) {
            // Log but don't fail
            \Log::error('Contact form email failed: ' . $e->getMessage());
        }

        session()->forget(['captcha_question', 'captcha_answer']);

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
