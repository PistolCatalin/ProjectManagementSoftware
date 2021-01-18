@role('admin')
<style>
#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: var(--secondary);
    color: #fff;
    transition: all 0.3s;
}
#sidebar.active {
    min-width: 80px;
    max-width: 80px;
    text-align: center;
}

/* Toggling the sidebar header content, hide the big heading [h3] and showing the small heading [strong] and vice versa*/
#sidebar .sidebar-header strong {
    display: none;
}
#sidebar.active .sidebar-header h3 {
    display: none;
}
#sidebar.active .sidebar-header strong {
    display: block;
}

#sidebar ul li a {
    text-align: left;
}

#sidebar.active ul li a {
    padding: 20px 10px;
    text-align: center;
    font-size: 0.85em;
}

#sidebar.active ul li a i {
    margin-right:  0;
    display: block;
    font-size: 1.8em;
    margin-bottom: 5px;
}

/* Same dropdown links padding*/
#sidebar.active ul ul a {
    padding: 10px !important;
}
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

#sidebar {
    /* don't forget to add all the previously mentioned styles here too */
    background: var(--secondary);
    color: #fff;
    transition: all 0.3s;
}

#sidebar .sidebar-header {
    padding: 20px;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    background: #fff;
    color: #313131;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    background: #fff;
    color: #313131;
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
}
/* Changing the arrow position to bottom center position, 
   translateX(50%) works with right: 50% 
   to accurately  center the arrow */
#sidebar.active .dropdown-toggle::after {
    top: auto;
    bottom: 10px;
    right: 50%;
    -webkit-transform: translateX(50%);
    -ms-transform: translateX(50%);
    transform: translateX(50%);
}
@media (max-width: 768px) {
    /* 80px and its content aligned to centre. Pushing it off the screen with the
       negative left margin
    */
    #sidebar.active {
        min-width: 80px;
        max-width: 80px;
        text-align: center;
        margin-left: -80px !important;
    }


    /* Reappearing the sidebar on toggle button click */
    #sidebar {
        margin-left: 0; 
        min-width: 250px;
        max-width: 250px;
        min-height: 100vh;
    }
    /* Toggling the sidebar header content, 
       hide the big heading [h3] and showing the small heading [strong] and vice versa
    */
    #sidebar .sidebar-header strong {
        display: none;
    }
    #sidebar.active .sidebar-header h3 {
        display: none;
    }
    #sidebar.active .sidebar-header strong {
        display: block;
    }

    /* Downsize the navigation links font size */
    #sidebar.active ul li a {
        padding: 20px 10px;
        font-size: 0.85em;
    }

    #sidebar.active ul li a i {
        margin-right:  0;
        display: block;
        font-size: 1.8em;
        margin-bottom: 5px;
    }

    /* Adjust the dropdown links padding*/
    #sidebar.active ul ul a {
        padding: 10px !important;
    }

    /* Changing the arrow position to bottom center position, 
      translateX(50%) works with right: 50% 
      to accurately  center the arrow */
    .dropdown-toggle::after {
        top: auto;
        bottom: 10px;
        right: 50%;
        -webkit-transform: translateX(50%);
        -ms-transform: translateX(50%);
        transform: translateX(50%);
    }
}
</style>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Project Management Software</h3>
        <strong>PMS</strong>
    </div>

    <ul class="list-unstyled components">

        <li>
            <a href="{{ url('/tasks') }}">
                <i class="fas fa-briefcase"></i>
                Tasks
            </a>
            <a href="{{ url('/projects') }}">
                <i class="fas fa-briefcase"></i>
                Projects
            </a>
            <a href="{{ url('/users') }}">
                <i class="fas fa-briefcase"></i>
                Users
            </a>
        </li>
    </ul>
</nav>
@endrole