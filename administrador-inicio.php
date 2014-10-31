<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Icon Panels Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Icon Panels <small>Bootstrap template, demonstrating a sample of panels with icons on top and hover effects</small></h1>
</div>

<!-- Icon Panels - START -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
                <div class="icon">
                    <div class="image"><span class="glyphicon glyphicon-list-alt btn-lg white"></span></div>
                    <div class="info">
                        <h3 class="title">Tasks</h3>
                        <p>
                            12 pending tasks awaiting approval and review.
                        </p>
                        <div class="more">
                            <a href="#" title="Title Link"><i class="fa fa-plus"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
                <div class="icon">
                    <div class="image"><span class="glyphicon glyphicon-envelope btn-lg white"></span></div>
                    <div class="info">
                        <h3 class="title">Messages</h3>
                        <p>
                            7 new messages over the past 24 hours. 
                        </p>
                        <div class="more">
                            <a href="#" title="Title Link"><i class="fa fa-plus"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
                <div class="icon">
                    <div class="image"><span class="glyphicon glyphicon-volume-up btn-lg white"></span></div>
                    <div class="info">
                        <h3 class="title">Mentions</h3>
                        <p>
                            47 new mentions for the past week.
                        </p>
                        <div class="more">
                            <a href="#" title="Title Link"><i class="fa fa-plus"></i> Details
                            </a>
                        </div>
                    </div>
                </div>
                <div class="space"></div>
            </div>
        </div>
    </div>
</div>

<style>
.white {
    color: white;
}

.btn-lg {
    font-size: 38px;
    line-height: 1.33;
    border-radius: 6px;
}

.box > .icon {
    text-align: center;
    position: relative;
}

.box > .icon > .image {
    position: relative;
    z-index: 2;
    margin: auto;
    width: 88px;
    height: 88px;
    border: 7px solid white;
    line-height: 88px;
    border-radius: 50%;
    background: #63B76C;
    vertical-align: middle;
}

.box > .icon:hover > .image {
    border: 4px solid black;
}

.box > .icon > .image > i {
    font-size: 40px !important;
    color: #fff !important;
}

.box > .icon:hover > .image > i {
    color: white !important;
}

.box > .icon > .info {
    margin-top: -24px;
    background: rgba(0, 0, 0, 0.04);
    border: 1px solid #e0e0e0;
    padding: 15px 0 10px 0;
}

    .box > .icon > .info > h3.title {
        color: #222;
        font-weight: 500;
    }

    .box > .icon > .info > p {
        color: #666;
        line-height: 1.5em;
        margin: 20px;
    }

.box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a {
    color: #222;
}

.box > .icon > .info > .more a {
    color: #222;
    line-height: 12px;
    text-transform: uppercase;
    text-decoration: none;
}

.box > .icon:hover > .info > .more > a {
    color: #000;
    padding: 6px 8px;
    border-bottom: 4px solid black;
}

.box .space {
    height: 30px;
}
</style>

<!-- Icon Panels - END -->

</div>

</body>
</html>