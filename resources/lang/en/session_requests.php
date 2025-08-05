<?php

return [
    'title' => 'Session Requests - EduConnect',
    'session_requests' => 'Session Requests',
    'manage_requests' => 'Manage incoming tutoring requests',
    
    'create' => [
        'title' => 'Request Session',
        'subtitle' => 'Request a tutoring session with :tutor',
        'form_title' => 'Session Request Details',
        'subject' => 'Subject',
        'select_subject' => 'Select a subject',
        'preferred_datetime' => 'Preferred Date & Time',
        'duration' => 'Duration',
        'select_duration' => 'Select duration',
        'minutes' => 'minutes',
        'hour' => 'hour',
        'hours' => 'hours',
        'message' => 'Message (Optional)',
        'message_placeholder' => 'Tell the tutor about your learning goals, specific topics you need help with, or any other relevant information...',
        'message_limit' => 'Maximum 500 characters',
        'cancel' => 'Cancel',
        'send_request' => 'Send Request',
        'errors' => [
            'title' => 'Please fix the following errors:',
        ],
    ],
    
    'stats' => [
        'pending' => 'Pending',
        'accepted' => 'Accepted',
        'declined' => 'Declined',
        'total_requests' => 'Total Requests',
    ],
    
    'tabs' => [
        'pending_requests' => 'Pending Requests',
        'accepted' => 'Accepted',
        'all_requests' => 'All Requests',
    ],
    
    'empty_state' => [
        'title' => 'No session requests',
        'description' => 'You haven\'t received any tutoring requests yet.',
        'update_profile' => 'Update Profile',
    ],
    
    'request_card' => [
        'mathematics_request' => 'Mathematics Tutoring Request',
        'from_student' => 'from :student',
        'requested_time' => 'Requested :time ago',
        'pending_status' => 'Pending',
        'subject' => 'Subject: :subject',
        'level' => 'Level: :level',
        'duration' => 'Duration: :duration',
        'preferred_date' => 'Preferred Date: :date',
        'time' => 'Time: :time',
        'rate' => 'Rate: :rate',
        'student_message' => 'Student\'s Message:',
        'sample_message' => 'Hi! I\'m struggling with quadratic equations and need help preparing for my upcoming test. I\'m available most afternoons this week. Thank you!',
        'view_profile' => 'View Profile',
        'decline' => 'Decline',
        'accept_request' => 'Accept Request',
    ],
    
    'success' => [
        'request_sent' => 'Session request sent successfully!',
        'request_approved' => 'Session request approved successfully!',
        'request_rejected' => 'Session request rejected successfully!',
        'request_cancelled' => 'Session request cancelled successfully!',
    ],
    
    'errors' => [
        'not_authorized' => 'You are not authorized to perform this action.',
        'duplicate_request' => 'You already have a pending request for this tutor and subject.',
        'request_failed' => 'Failed to send session request. Please try again.',
        'update_failed' => 'Failed to update session request. Please try again.',
        'cannot_cancel' => 'Cannot cancel this request as it has already been processed.',
    ],
];
