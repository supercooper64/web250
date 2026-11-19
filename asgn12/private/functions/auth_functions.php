<?php

declare(strict_types=1);

function is_logged_in(): bool
{
    return isset($_SESSION['member_id']);
}

function require_login(): void
{
    if (!is_logged_in()) {

        header('Location: login.php');
        exit;
    }
}

function current_member(): ?Member
{
    if (!is_logged_in()) {
        return null;
    }

    return Member::find_by_id((int) $_SESSION['member_id']);
}

function is_member(): bool
{
    return current_member() !== null;
}

function is_admin(): bool
{
    $member = current_member();

    return $member !== null
        && $member->role === 'admin';
}

function require_admin(): void
{
    if (!is_admin()) {
        http_response_code(403);
        exit('Administrator access required.');
    }
}
