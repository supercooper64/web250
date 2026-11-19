<?php

$prefix = !empty($admin_nav)
    ? '../'
    : '';

$nav_member = current_member();

$nav_is_admin =
    $nav_member !== null
    && $nav_member->role === 'admin';

?>

<nav>

    <a href="<?php print $prefix; ?>index.php">
        Home
    </a>

    |

    <a href="<?php print $prefix; ?>birds.php">
        Birds
    </a>

    <?php if ($nav_member !== null) { ?>

        |

        <a href="<?php print $prefix; ?>bird_new.php">
            Create Bird
        </a>

        <?php if ($nav_is_admin) { ?>

            |

            <a href="<?php print $prefix; ?>admin/members.php">
                Manage Members
            </a>

        <?php } ?>

        |

        <a href="<?php print $prefix; ?>logout.php">
            Logout
        </a>,

        <?php print h($nav_member->first_name); ?>

    <?php } else { ?>

        |

        <a href="<?php print $prefix; ?>login.php">
            Login
        </a>

        |

        <a href="<?php print $prefix; ?>signup.php">
            Register
        </a>

    <?php } ?>

</nav>

<hr>