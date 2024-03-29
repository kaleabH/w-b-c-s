<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{$page_name} - Student Online Clearance System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="{$host}/public/css/bootstrap.css">
    <link rel="stylesheet" href="{$host}/public/css/font-awesome.css">
    <link rel="stylesheet" href="{$host}/public/css/font-awesome-ext.css">
    <link rel="stylesheet" href="{$host}/public/css/bootstrap-fileupload.css">
    <link rel="stylesheet" href="{$host}/public/select2/select2.css">
    <link rel="stylesheet" href="{$host}/public/socs-icons/socs-icons.css">
    <style>
        @media (min-width: 480px) {

            body {
                background-image: url('{$host}/public/img/background.png');
            }

            .socs-content {
                background-color: white;
                box-shadow: 5px 5px 7px #444;
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 10px;
                padding-bottom: 20px;
                opacity: 0.9;
                margin-bottom: 5px;
            }
        }

        @media (max-width: 480px) {

            body {
                font-size: 75%;
            }
        }

        body {
            padding-top: 45px;
            padding-bottom: 40px;
            background-attachment: fixed;
            background-position: top;
            background-repeat: repeat-x;
        }

        #welcome {
            background: url('{$host}/public/img/title.png');
            background-position: bottom right;
            background-repeat: no-repeat;
        }

        #header {
            background-image: url('{$host}/public/img/header.png');
            background-position: right;
            background-repeat: no-repeat;
        }
    </style>
    <link rel="stylesheet" href="{$host}/public/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="{$host}/public/css/main.css">

    <script src="{$host}/public/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="{$host}/public/js/calendarview.js"></script>
    <script src="{$host}/public/js/prototype.js"></script>
</head>

<body>
    <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

    <!-- This code is is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

    {include file='UIsections.tpl'}

    <div class="navbar navbar-inverse navbar-fixed-top" id="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="index.php"><img src="{$host}/public/img/logo.png"> SOCS{*{$page_name}*}</a>
                <div class="nav-collapse collapse">

                    {if isset($username)}
                        <div class="btn-group pull-right">
                            <button class="btn btn-inverse" onclick="window.location.href = 'index.php';">
                                <i class="icon-user icon-white"></i> {$username}
                            </button>
                            <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{$host}/settings.php"><i class="icon-wrench"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="{$host}/index.php?action=logout"><i class="icon-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    {elseif isset($smarty.get.action) && !isset($username)}

                        {call name=welcome_navigations}

                        {if $smarty.get.action == "student_registrationForm"}
                            <form class="navbar-form pull-right" action="index.php?action=login" method="post">
                                <input class="span2" type="text" placeholder="Username" name="username" required>
                                <input class="span2" type="password" placeholder="Password" name="password" required>
                                <button type="submit" class="btn"><i class="icon-check"></i> Sign in</button>
                            </form>
                        {/if}

                    {else}
                        {call name=welcome_navigations}

                        <form class="navbar-form pull-right" action="index.php?action=login" method="post">
                            <input class="span2" type="text" placeholder="Username" name="username" required>
                            <input class="span2" type="password" placeholder="Password" name="password" required>
                            <button type="submit" class="btn"><i class="icon-check"></i> Sign in</button>
                        </form>
                    {/if}

                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>

    {if isset($username)}
        <div id="header" class="container socs-content">
            <div class="row">
                <div class="span1">

                    {if isset($photo)}
                        <img src="{$photo}" class="img-polaroid" />
                    {else}
                        <img src="{$host}/photos/default.png" class="img-polaroid" />
                    {/if}

                </div>
                <div class="span5">
                    <h4>{$surname}, {$firstname} {$middlename}.</h4>
                    <h5>- {$account_type} {$assign_sign}</h5>
                </div>
            </div>
        </div>
    {/if}

    <div class="container socs-content">

        {if isset($smarty.get.action)}
            {if $alert != "" && $smarty.get.action == "logout" || $smarty.get.action == "login_error"}
                {$alert}
            {/if}
        {/if}

        {include file=$content}

        <hr>

        <footer>
            <p>&copy; Micolink Information Technology College - Department of Computer Science - Student Online
                Clearance System {$smarty.now|date_format: "%Y"}</p>
        </footer>

    </div>

    {call name=upload_excel}
    {call name="replace_dept_signatory"}
    {call name="add_dept_signatory"}
    {call name="forgot_pass_modal"}

    {if isset($smarty.get.action)}
        {if $alert != "" && $smarty.get.action != "logout" && $smarty.get.action != "login_error"}
            <div id="socs-alert" class="modal hide fade">
                <div class="modal-body">
                    {$alert}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        {/if}
    {/if}

    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
    <!--<script>window.jQuery || document.write('<script src="{$host}/js/vendor/jquery-1.8.3.min.js"><\/script>')</script>-->

    <script src="{$host}/public/js/vendor/jquery-1.8.3.min.js"></script>
    <script src="{$host}/public/js/vendor/bootstrap.min.js"></script>
    <script src="{$host}/public/js/vendor/bootbox.min.js"></script>
    <script src="{$host}/public/js/vendor/bootstrap-fileupload.js"></script>
    <script src="{$host}/public/js/vendor/bootstrap-progressbar.js"></script>
    <script src="{$host}/public/select2/select2.js"></script>
    <script src="{$host}/public/js/vendor/jquery.cookie.js"></script>
    <script src="{$host}/public/js/main.js"></script>

    {if isset($sy_attended) && isset($sem_attended)}
        {if ($sy_attended != $most_current_sy || $sem_attended != $most_current_sem)}
            <script type="text/javascript">
                var renew = "{$host}/student/index.php?action=renew_student";
                var username = {$username} + "";

                {literal}
                    $(document).ready(function() {

                        if ($.cookie(username) !== "no") {
                            bootbox.confirm(
                                "<div class='alert alert-info'><i class='icon-info-sign'></i> <strong>Alright!</strong> Classes are already starting. Do you want to renew your clearance?</div>",
                                function(result) {
                                    if (result === true) {
                                        window.location.href = renew;

                                        $.removeCookie(username);
                                    } else {
                                        $.cookie(username, 'no', {expires: 1});
                                    }
                                });
                        }
                    });

                    $('#socs-renew').on('click', function() {
                        bootbox.confirm(
                            "<div class='alert alert-info'><i class='icon-info-sign'></i> <strong>Alright!</strong> Classes are already starting. Do you want to renew your clearance?</div>",
                            function(result) {
                                if (result === true) {
                                    window.location.href = renew;
                                    console.log("inside the confirmation")
                                }
                            });
                    });
                {/literal}
            </script>
        {/if}
    {/if}

    {*
        {literal}
        <script>
        var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        {/literal}
        *}

</body>

</html>