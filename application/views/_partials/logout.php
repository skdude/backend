
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a data-toggle='dropdown' class='dropdown-toggle' href='#'>
                <i class="fa fa-user"></i>
                <span class='caret'></span>
            </a>
            <ul role='menu' class='dropdown-menu'>
                <?php if ( $this->ion_auth->logged_in() ): ?>
                    <li>
                        <a href="profile/index">My profile</a>
                    </li>
                    <li>
                        <a href="login/logout">Logout</a>
                    </li>

                <?php else: ?>
                    <li>
                        <a href="register/index">Register</a>
                    </li>
                    <li>
                        <a href="login/index">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>


    </ul>
