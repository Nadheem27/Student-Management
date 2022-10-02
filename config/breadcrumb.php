<?php

return [
    'student-list' => [
        'title' => 'Student List',
        'links' => array(
            [
                'text' => 'Add Student',
                'url' => 'student.student-add'
            ],
            [
                'text' => 'Switch to Marks',
                'url' => 'mark.mark',
            ],
        ),
    ],
    'student-add' => [
        'title' => 'Add Student',
        'links' => array(
            [
                'text' => 'Back to List',
                'url' => 'student.student'
            ],
            [
                'text' => 'Switch to Marks',
                'url' => 'mark.mark',
            ],
        ),
    ],
    'student-edit' => [
        'title' => 'Edit Student',
        'links' => array(
            [
                'text' => 'Back to List',
                'url' => 'student.student'
            ],
            [
                'text' => 'Switch to Marks',
                'url' => 'mark.mark',
            ],
        ),
    ],
    'mark-list' => [
        'title' => 'Mark List',
        'links' => array(
            [
                'text' => 'Add Mark',
                'url' => 'mark.mark-add'
            ],
            [
                'text' => 'Switch to Students',
                'url' => 'student.student',
            ],
        ),
    ],
    'mark-add' => [
        'title' => 'Add Mark',
        'links' => array(
            [
                'text' => 'Back to List',
                'url' => 'mark.mark'
            ],
            [
                'text' => 'Switch to Students',
                'url' => 'student.student',
            ],
        ),
    ],
    'mark-edit' => [
        'title' => 'Edit Mark',
        'links' => array(
            [
                'text' => 'Back to List',
                'url' => 'mark.mark'
            ],
            [
                'text' => 'Switch to Students',
                'url' => 'student.student',
            ],
        ),
    ],
];