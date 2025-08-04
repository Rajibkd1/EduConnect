<?php

return [
    'title' => 'Create Sessions - EduConnect',
    'page_title' => 'Create Sessions',
    'page_description' => 'Set up your availability and create tutoring sessions',
    
    'quick_actions' => [
        'create_new' => [
            'title' => 'Create New Session',
            'description' => 'Schedule a one-time tutoring session',
            'button' => 'Create Session',
        ],
        'set_availability' => [
            'title' => 'Set Availability',
            'description' => 'Define your weekly availability',
            'button' => 'Set Schedule',
        ],
        'bulk_sessions' => [
            'title' => 'Bulk Sessions',
            'description' => 'Create multiple sessions at once',
            'button' => 'Bulk Create',
        ],
    ],
    
    'form' => [
        'title' => 'Create New Session',
        'subject' => 'Subject',
        'select_subject' => 'Select Subject',
        'level' => 'Level',
        'select_level' => 'Select Level',
        'date' => 'Date',
        'start_time' => 'Start Time',
        'duration' => 'Duration',
        'price_per_hour' => 'Price per Hour ($)',
        'price_placeholder' => '35.00',
        'max_students' => 'Max Students',
        'session_type' => 'Session Type',
        'online_session' => 'Online Session',
        'online_description' => 'Video call via platform',
        'in_person' => 'In-Person',
        'in_person_description' => 'Meet at agreed location',
        'session_description' => 'Session Description',
        'description_placeholder' => 'Describe what will be covered in this session...',
        'prerequisites' => 'Prerequisites (Optional)',
        'prerequisites_placeholder' => 'Basic algebra knowledge, calculator required...',
        'save_draft' => 'Save as Draft',
        'create_session' => 'Create Session',
    ],
    
    'levels' => [
        'elementary' => 'Elementary',
        'middle' => 'Middle School',
        'high' => 'High School',
        'college' => 'College',
    ],
    
    'durations' => [
        '30' => '30 minutes',
        '60' => '1 hour',
        '90' => '1.5 hours',
        '120' => '2 hours',
    ],
    
    'max_students_options' => [
        '1' => '1 (Individual)',
        '2' => '2 students',
        '3' => '3 students',
        '4' => '4 students',
        '5' => '5 students',
    ],
    
    'recent_sessions' => [
        'title' => 'Recent Sessions',
        'no_sessions' => 'No sessions created yet',
        'sessions_appear_here' => 'Your created sessions will appear here',
    ],
];
