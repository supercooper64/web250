<?php

declare(strict_types=1);

require_once '../../private/initialize.php';

require_admin(); 

$admin_nav = true;

require __DIR__ . '/../nav.php';

$members = Member::find_all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Members</title>
</head>
<body>

<h1>Members</h1>

<p>
    <a href="index.php">Admin Home</a>
</p>

<p>
    <a href="new_member.php">Create Member</a>
</p>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($members as $member) { ?>

        <tr>

            <td><?php print $member->id; ?></td>

            <td>
                <?php
                print $member->first_name .
                    ' ' .
                    $member->last_name;
                ?>
            </td>

            <td><?php print $member->username; ?></td>

            <td><?php print $member->email; ?></td>

            <td><?php print $member->role; ?></td>

            <td>
                <a href="member.php?id=<?php print $member->id; ?>">
                    View
                </a>

                |

                <a href="edit_member.php?id=<?php print $member->id; ?>">
                    Edit
                </a>

                |

                <a href="delete_member.php?id=<?php print $member->id; ?>">
                    Delete
                </a>
            </td>

        </tr>

    <?php } ?>

</table>

</body>
</html>