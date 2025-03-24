<?php

return [
    "project" => [
        "name" => "Project Alpha",
        "description" => "Test project",
    ],
    "module" => [
        "name" => "Authentication",
    ],
    "task" => [
        "name" => "User Login",
        "description" => "User can log in with valid credentials.",
        "expected_flow" => [
            "User visits the login page",
            "User enters their credentials",
            "System validates credentials",
            "User is redirected to dashboard on success",
            "Error message is shown on failure",
        ],
    ],
    "testCase" => [
        "title" => "User Login Test",
        "description" => "Verify that a user can log in with valid credentials.",
        "steps" => [
            "Navigate to login page",
            "Enter valid username and password",
            "Click login button",
        ],
        "obtained_result" => "User is redirected to the dashboard",
        "test_comments" => "",
    ],
    "testCaseComment" => [
        "comment_1" => "Initial test case comment by John.",
        "comment_2" => "Sara adds her thoughts on the test case.",
        "comment_3" => "Sara questions the validity of John's comment.",
        "comment_4" => "John reaffirms his position in response to Sara.",
    ],
    "bugReport" => [
        "title" => "Task 1 does not display the correct information",
        "description" => "When I navigate to the details of Task 1, it shows the description of Task 2.",
        "steps_to_reproduce" => [
            "Navigate to the project where Task 1 is located.",
            "Click on the card of Task 1.",
            "Verify that the description of Task 1 is not displayed.",
        ],
    ],
    "bugReportComment" => [
        "comment_1" => "Initial bug report comment by John.",
        "comment_2" => "Sara adds her thoughts on the bug report.",
        "comment_3" => "Sara questions the validity of John's comment.",
        "comment_4" => "John reaffirms his position in response to Sara.",
    ]
];
