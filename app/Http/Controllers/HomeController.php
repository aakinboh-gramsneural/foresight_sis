<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Stat;
use App\Models\Service;
use App\Models\Faq;
use App\Models\CaseStudy;
use App\Models\SiteSetting;
use App\Models\FooterSetting;

class HomeController extends Controller
{
    public function __invoke()
    {
        $whyCards = [
            ['title' => SiteSetting::get('why_choose_1_title', 'Proven Expertise'), 'desc' => SiteSetting::get('why_choose_1_desc', ''), 'icon' => SiteSetting::get('why_choose_1_icon', 'trophy')],
            ['title' => SiteSetting::get('why_choose_2_title', 'Tailored Solutions'), 'desc' => SiteSetting::get('why_choose_2_desc', ''), 'icon' => SiteSetting::get('why_choose_2_icon', 'puzzle-piece')],
            ['title' => SiteSetting::get('why_choose_3_title', 'Lasting Impact'), 'desc' => SiteSetting::get('why_choose_3_desc', ''), 'icon' => SiteSetting::get('why_choose_3_icon', 'chart-trending-up')],
        ];

        try {
            $slides = HeroSlide::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $slides = collect([]);
        }

        try {
            $stats = Stat::orderBy('order')->get();
        } catch (\Exception $e) {
            $stats = collect([]);
        }

        try {
            $services = Service::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $services = collect([]);
        }

        try {
            $faqs = Faq::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $faqs = collect([]);
        }

        try {
            $caseStudies = CaseStudy::orderBy('order')->get();
        } catch (\Exception $e) {
            $caseStudies = collect([]);
        }

        return view('pages.home', [
            'slides' => $slides,
            'stats' => $stats,
            'services' => $services,
            'faqs' => $faqs,
            'caseStudies' => $caseStudies,
            'whyCards' => $whyCards,
            'whoWeAre' => SiteSetting::get('who_we_are_text', 'Foresight Corporate Governance Consulting is a trusted advisory firm specializing in governance, compliance, and strategic consulting.'),
            'whoWeAreImage' => SiteSetting::get('who_we_are_image', '/images/who-we-are.jpg'),
        ]);
    }
}
