<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\Stat;
use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\Faq;
use App\Models\CaseStudy;
use App\Models\ContactInfo;
use App\Models\SiteSetting;
use App\Models\Page;
use App\Models\FooterSetting;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Slides
        $slides = [
            ['title' => 'Corporate Governance Excellence', 'subtitle' => 'Building stronger boards, better policies, and sustainable organizations.', 'image_url' => '/images/hero-1.jpg', 'order' => 1],
            ['title' => 'Strategic Consulting Solutions', 'subtitle' => 'Expert guidance for organizations navigating complex governance challenges.', 'image_url' => '/images/hero-2.jpg', 'order' => 2],
            ['title' => 'Training & Development', 'subtitle' => 'Empowering leaders with the knowledge and skills to govern effectively.', 'image_url' => '/images/hero-3.jpg', 'order' => 3],
        ];
        foreach ($slides as $slide) {
            HeroSlide::create(array_merge($slide, ['is_active' => true]));
        }

        // Stats (IMPORTANT: 20+ years, 100+ success)
        Stat::create(['label' => 'Years Experience', 'value' => 20, 'suffix' => '+', 'order' => 1]);
        Stat::create(['label' => 'Success Cases', 'value' => 100, 'suffix' => '+', 'order' => 2]);
        Stat::create(['label' => 'Corporate Governance', 'value' => 50, 'suffix' => '+', 'order' => 3]);
        Stat::create(['label' => 'Client Satisfaction', 'value' => 98, 'suffix' => '%', 'order' => 4]);

        // Services (What We Do) - NO Marketing service
        $services = [
            ['title' => 'Governance & Policies', 'description' => 'Comprehensive governance frameworks, board development, and policy creation for organizations of all sizes.', 'icon' => 'shield-check', 'image_url' => '/images/service-governance.jpg', 'order' => 1],
            ['title' => 'Training & Retreats', 'description' => 'Customized training programs, board retreats, and professional development workshops.', 'icon' => 'academic-cap', 'image_url' => '/images/service-training.jpg', 'order' => 2],
            ['title' => 'Admin & Compliance', 'description' => 'Administrative support, regulatory compliance, and organizational process optimization.', 'icon' => 'clipboard-document-check', 'image_url' => '/images/service-admin.jpg', 'order' => 3],
            ['title' => 'Investment Portfolio Consulting', 'description' => 'Investment portfolio consulting, strategic planning, and organizational transformation.', 'icon' => 'chart-bar', 'image_url' => '/images/service-strategic.jpg', 'order' => 4],
        ];
        foreach ($services as $service) {
            Service::create(array_merge($service, ['is_active' => true]));
        }

        // Service Sections (for Services page detail - zigzag layout)
        $sections = [
            [
                'tag' => 'Governance',
                'title' => 'Governance & Policies',
                'description' => 'Establishing the framework for ethical and effective management. We help boards, management and executive leadership teams navigate complex regulatory environments.',
                'image_url' => '/images/section-governance.jpg',
                'order' => 1,
                'items' => [
                    ['text' => 'Board Development & Effectiveness'],
                    ['text' => 'Policy Development & Review'],
                    ['text' => 'Governance Frameworks'],
                    ['text' => 'Risk Management'],
                    ['text' => 'Organizational Bylaws'],
                    ['text' => 'Compliance Programs'],
                ],
            ],
            [
                'tag' => 'Training',
                'title' => 'Training & Retreats',
                'description' => 'Our training programs are designed to empower boards, executives, and staff with the knowledge and tools they need to excel in their governance roles.',
                'image_url' => '/images/section-training.jpg',
                'order' => 2,
                'items' => [
                    ['text' => 'Board Orientation Programs'],
                    ['text' => 'Governance Training Workshops'],
                    ['text' => 'Strategic Planning Retreats'],
                    ['text' => 'Leadership Development'],
                    ['text' => 'Team Building Sessions'],
                    ['text' => 'Meeting Facilitation'],
                ],
            ],
            [
                'tag' => 'Administration',
                'title' => 'Admin & Compliance',
                'description' => 'We provide comprehensive administrative and compliance support to ensure your organization operates smoothly and meets all regulatory requirements.',
                'image_url' => '/images/section-admin.jpg',
                'order' => 3,
                'items' => [
                    ['text' => 'Corporate Secretarial Services'],
                    ['text' => 'Regulatory Compliance'],
                    ['text' => 'Document Management'],
                    ['text' => 'Annual Filing & Reporting'],
                    ['text' => 'Meeting Minutes & Records'],
                    ['text' => 'Policy Implementation'],
                ],
            ],
            [
                'tag' => 'Strategy',
                'title' => 'Investment Portfolio Consulting',
                'description' => 'Our strategic consulting services help organizations navigate complex challenges and capitalize on opportunities for sustainable growth.',
                'image_url' => '/images/section-strategic.jpg',
                'order' => 4,
                'items' => [
                    ['text' => 'Investment Portfolio Review'],
                    ['text' => 'Strategic Planning'],
                    ['text' => 'Organizational Transformation'],
                    ['text' => 'Performance Optimization'],
                    ['text' => 'Stakeholder Engagement'],
                    ['text' => 'Change Management'],
                ],
            ],
        ];
        foreach ($sections as $section) {
            ServiceSection::create($section);
        }

        // FAQs
        $faqs = [
            ['question' => 'What type of businesses do you work with?', 'answer' => 'We work with startups, SMEs, and large enterprises across various industries including but not limited to finance, healthcare, technology, education, government agencies, not for profits and boards.', 'order' => 1],
            ['question' => 'How can governance consulting benefit my organization?', 'answer' => 'Effective governance consulting helps organizations establish clear accountability structures, improve decision-making processes, manage risks effectively, and ensure compliance with regulations. This leads to stronger organizational performance and stakeholder confidence.', 'order' => 2],
            ['question' => 'Do you offer customized training programs?', 'answer' => 'Yes, all our training programs are customized to address the specific needs and challenges of your organization. We work closely with you to develop content that is relevant, practical, and immediately applicable.', 'order' => 3],
            ['question' => 'What industries do you specialize in?', 'answer' => 'While we are generalist experts in governance, our deepest experience lies in corporate law, corporate finance, and regulatory compliance sectors.', 'order' => 4],
        ];
        foreach ($faqs as $faq) {
            Faq::create(array_merge($faq, ['is_active' => true]));
        }

        // Case Studies
        $caseStudies = [
            ['title' => 'Board Governance Review', 'image_url' => '/images/case-1.jpg', 'order' => 1],
            ['title' => 'Strategic Planning Workshop', 'image_url' => '/images/case-2.jpg', 'order' => 2],
            ['title' => 'Policy Development Framework', 'image_url' => '/images/case-3.jpg', 'order' => 3],
            ['title' => 'Compliance Audit Program', 'image_url' => '/images/case-4.jpg', 'order' => 4],
            ['title' => 'Leadership Training Initiative', 'image_url' => '/images/case-5.jpg', 'order' => 5],
        ];
        foreach ($caseStudies as $cs) {
            CaseStudy::create($cs);
        }

        // Contact Info
        ContactInfo::create(['type' => 'phone', 'label' => 'Phone', 'value' => '4036671396', 'icon' => 'phone', 'order' => 1]);
        ContactInfo::create(['type' => 'email', 'label' => 'Email', 'value' => 'admin@foresightcosec.com', 'icon' => 'envelope', 'order' => 2]);
        ContactInfo::create(['type' => 'address', 'label' => 'Location', 'value' => 'Calgary, Alberta, Canada', 'icon' => 'map-pin', 'order' => 3]);
        ContactInfo::create(['type' => 'hours', 'label' => 'Business Hours', 'value' => 'Mon - Fri: 9:00 AM - 5:00 PM', 'icon' => 'clock', 'order' => 4]);

        // Site Settings - Who We Are
        SiteSetting::create(['key' => 'who_we_are_text', 'value' => 'Foresight Corporate Governance Consulting is a trusted advisory firm specializing in governance, compliance, and strategic consulting. With over 20 years of experience, we help organizations build robust governance frameworks that drive accountability, transparency, and sustainable growth. Our team of experts brings deep expertise across corporate governance, board development, policy creation, and organizational strategy.', 'group' => 'about']);
        SiteSetting::create(['key' => 'who_we_are_image', 'value' => '/images/who-we-are.jpg', 'group' => 'about']);

        // Why Choose Us cards
        SiteSetting::create(['key' => 'why_choose_1_title', 'value' => 'Proven Expertise', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_1_desc', 'value' => 'Over 20 years of experience in corporate governance consulting across diverse industries and sectors.', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_1_icon', 'value' => 'trophy', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_2_title', 'value' => 'Tailored Solutions', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_2_desc', 'value' => 'Every engagement is customized to address your unique governance challenges and organizational objectives.', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_2_icon', 'value' => 'puzzle-piece', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_3_title', 'value' => 'Lasting Impact', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_3_desc', 'value' => 'We deliver sustainable governance frameworks that continue to benefit your organization long after our engagement ends.', 'group' => 'why_choose_us']);
        SiteSetting::create(['key' => 'why_choose_3_icon', 'value' => 'chart-trending-up', 'group' => 'why_choose_us']);

        // About Page
        Page::create([
            'slug' => 'about',
            'title' => 'About Foresight CGC',
            'meta_description' => 'Learn about Foresight Corporate Governance Consulting - over 20 years of expertise in governance, compliance, and strategic consulting.',
            'content' => [
                'hero_subtitle' => 'Our Story, Mission & Vision',
                'story_title' => 'Our Story',
                'story_text' => "Foresight Corporate Governance Consulting was founded with a clear mission: to help organizations establish and maintain effective governance practices. Our journey has been marked by a relentless commitment to excellence, integrity, and client success. We believe that strong governance is the foundation of organizational success, and we are passionate about helping our clients build governance frameworks that stand the test of time.\n\nWe provide a combined multi-disciplinary experience with serving small, medium and large organizations and a Chartered Arbitration, Mediation, Contract Administration, Management and Regulatory background. For the ease of our clients, we facilitate virtual meetings and services.",
                'mission_title' => 'Our Mission',
                'mission_text' => 'To empower organizations with the governance frameworks, strategic guidance, and training they need to operate with integrity, accountability, and excellence.',
                'vision_title' => 'Our Vision',
                'vision_text' => 'To be the leading corporate governance consulting firm, recognized for our expertise, innovation, and unwavering commitment to client success.',
                'values' => ['Integrity', 'Excellence', 'Accountability', 'Innovation', 'Collaboration'],
            ],
        ]);

        // Footer
        FooterSetting::create([
            'tagline' => 'Strategy, Solutions, Operations',
            'disclaimer' => 'Disclaimer: The information on this website is for informational purposes only and is in no way meant to be relied upon as any form of consulting advice nor legal advice in any way.',
            'social_links' => [
                ['name' => 'LinkedIn', 'url' => '#', 'icon' => 'linkedin'],
                ['name' => 'Twitter', 'url' => '#', 'icon' => 'twitter'],
            ],
        ]);
    }
}
