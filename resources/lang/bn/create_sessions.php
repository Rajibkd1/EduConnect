<?php

return [
    'title' => 'সেশন তৈরি করুন - এডুকানেক্ট',
    'page_title' => 'সেশন তৈরি করুন',
    'page_description' => 'আপনার সময়সূচী নির্ধারণ করুন এবং টিউটরিং সেশন তৈরি করুন',
    
    'quick_actions' => [
        'create_new' => [
            'title' => 'নতুন সেশন তৈরি করুন',
            'description' => 'একটি একক টিউটরিং সেশনের সময়সূচী করুন',
            'button' => 'সেশন তৈরি করুন',
        ],
        'set_availability' => [
            'title' => 'সময়সূচী নির্ধারণ করুন',
            'description' => 'আপনার সাপ্তাহিক সময়সূচী নির্ধারণ করুন',
            'button' => 'সময়সূচী সেট করুন',
        ],
        'bulk_sessions' => [
            'title' => 'বাল্ক সেশন',
            'description' => 'একসাথে একাধিক সেশন তৈরি করুন',
            'button' => 'বাল্ক তৈরি করুন',
        ],
    ],
    
    'form' => [
        'title' => 'নতুন সেশন তৈরি করুন',
        'subject' => 'বিষয়',
        'select_subject' => 'বিষয় নির্বাচন করুন',
        'level' => 'স্তর',
        'select_level' => 'স্তর নির্বাচন করুন',
        'date' => 'তারিখ',
        'start_time' => 'শুরুর সময়',
        'duration' => 'সময়কাল',
        'price_per_hour' => 'প্রতি ঘন্টার মূল্য (৳)',
        'price_placeholder' => '৩৫০০',
        'max_students' => 'সর্বোচ্চ শিক্ষার্থী',
        'session_type' => 'সেশনের ধরন',
        'online_session' => 'অনলাইন সেশন',
        'online_description' => 'প্ল্যাটফর্মের মাধ্যমে ভিডিও কল',
        'in_person' => 'সরাসরি',
        'in_person_description' => 'সম্মত স্থানে সাক্ষাৎ',
        'session_description' => 'সেশনের বিবরণ',
        'description_placeholder' => 'এই সেশনে কী কভার করা হবে তা বর্ণনা করুন...',
        'prerequisites' => 'পূর্বশর্ত (ঐচ্ছিক)',
        'prerequisites_placeholder' => 'মৌলিক বীজগণিত জ্ঞান, ক্যালকুলেটর প্রয়োজন...',
        'save_draft' => 'খসড়া সংরক্ষণ করুন',
        'create_session' => 'সেশন তৈরি করুন',
    ],
    
    'levels' => [
        'elementary' => 'প্রাথমিক',
        'middle' => 'মাধ্যমিক',
        'high' => 'উচ্চ মাধ্যমিক',
        'college' => 'কলেজ',
    ],
    
    'durations' => [
        '30' => '৩০ মিনিট',
        '60' => '১ ঘন্টা',
        '90' => '১.৫ ঘন্টা',
        '120' => '২ ঘন্টা',
    ],
    
    'max_students_options' => [
        '1' => '১ (ব্যক্তিগত)',
        '2' => '২ জন শিক্ষার্থী',
        '3' => '৩ জন শিক্ষার্থী',
        '4' => '৪ জন শিক্ষার্থী',
        '5' => '৫ জন শিক্ষার্থী',
    ],
    
    'recent_sessions' => [
        'title' => 'সাম্প্রতিক সেশন',
        'no_sessions' => 'এখনও কোন সেশন তৈরি করা হয়নি',
        'sessions_appear_here' => 'আপনার তৈরি করা সেশনগুলি এখানে প্রদর্শিত হবে',
    ],
];
