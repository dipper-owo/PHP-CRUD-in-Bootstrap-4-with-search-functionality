<?php include_once('config.php');
if (isset($_REQUEST['editId']) and $_REQUEST['editId'] != "") {
    $row = $db->getAllRecords('users', '*', ' AND id="' . $_REQUEST['editId'] . '"');
}

if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {
    extract($_REQUEST);
    if ($username == "") {
        header('location:' . $_SERVER['PHP_SELF'] . '?msg=un&editId=' . $_REQUEST['editId']);
        exit;
    } elseif ($useremail == "") {
        header('location:' . $_SERVER['PHP_SELF'] . '?msg=ue&editId=' . $_REQUEST['editId']);
        exit;
    } elseif ($userphone == "") {
        header('location:' . $_SERVER['PHP_SELF'] . '?msg=up&editId=' . $_REQUEST['editId']);
        exit;
    }
    $data = array(
        'username' => $username,
        'useremail' => $useremail,
        'userphone' => $userphone,
    );
    $update = $db->update('users', $data, array('id' => $editId));
    if ($update) {
        header('location: browse-users.php?msg=rus');
        exit;
    } else {
        header('location: browse-users.php?msg=rnu');
        exit;
    }
}
?>
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"
      prefix="og: http://ogp.me/ns#" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP CRUD in Bootstrap with search and pagination</title>

    <link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="bg-light border-bottom shadow-sm sticky-top">
    <div class="container">
        <header class="blog-header py-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light"><a class="navbar-brand text-muted p-0 m-0"
                                                                          href="https://learncodeweb.com"><img
                            src='https://learncodeweb.com/wp-content/uploads/2019/01/logo.png' alt='LearnCodeWeb'></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-17" class="active nav-item"><a title="Home" href="https://learncodeweb.com/"
                                                                         class="nav-link">Home</a></li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-16" class="nav-item"><a title="Web Development"
                                                                  href="https://learncodeweb.com/learn/web-development/"
                                                                  class="nav-link">Web Development</a></li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-558" class="nav-item"><a title="PHP"
                                                                   href="https://learncodeweb.com/learn/php/"
                                                                   class="nav-link">PHP</a></li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-14" class="nav-item"><a title="Bootstrap"
                                                                  href="https://learncodeweb.com/learn/bootstrap-framework/"
                                                                  class="nav-link">Bootstrap</a></li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-559" class="nav-item"><a title="WordPress"
                                                                   href="https://learncodeweb.com/learn/wordpress/"
                                                                   class="nav-link">WordPress</a></li>
                        <li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"
                            id="menu-item-15" class="nav-item"><a title="Snippets"
                                                                  href="https://learncodeweb.com/learn/snippets/"
                                                                  class="nav-link">Snippets</a></li>
                    </ul>
                    <form method="get" action="https://learncodeweb.com" class="form-inline my-2 my-lg-0">
                        <div class="input-group input-group-md">
                            <input type="text" class="form-control search-width" name="s" id="search" value=""
                                   placeholder="Search..." aria-label="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="searchBtn"><i
                                            class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
        </header>
    </div> <!--/.container-->
</div>


<div class="container">
    <h1><a href="https://learncodeweb.com/php/php-crud-in-bootstrap-4-with-search-functionality/">PHP CRUD in Bootstrap
            with search and pagination</a></h1>
    <?php
    if (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "un") {
        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';
    } elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "ue") {
        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';
    } elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "up") {
        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';
    } elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "ras") {
        echo '<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
    } elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rna") {
        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';
    }
    ?>
    <div class="card">
        <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a
                    href="browse-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i>
                Browse Users</a></div>
        <div class="card-body">

            <div class="col-sm-6">
                <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                <form method="post">
                    <div class="form-group">
                        <label>User Name <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control"
                               value="<?php echo $row[0]['username']; ?>" placeholder="Enter user name" required>
                    </div>
                    <div class="form-group">
                        <label>User Email <span class="text-danger">*</span></label>
                        <input type="email" name="useremail" id="useremail" class="form-control"
                               value="<?php echo $row[0]['useremail']; ?>" placeholder="Enter user email" required>
                    </div>
                    <div class="form-group">
                        <label>User Phone <span class="text-danger">*</span></label>
                        <input type="tel" name="userphone" id="userphone" maxlength="12" class="form-control"
                               value="<?php echo $row[0]['userphone']; ?>" placeholder="Enter user phone" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId'] ?>">
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i
                                    class="fa fa-fw fa-edit"></i> Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</body>
</html>