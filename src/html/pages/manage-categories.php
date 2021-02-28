<?php

include_once(dirname(__DIR__) . "\common\header.php");


$tags = ['PPIN', 'MF_II', 'Exam', 'COMP', 'IART', 'Python'];
$courses = ['MIEIC', 'MIEEC', 'MIEC', 'MIEIM'];

function display_cards($array)
{
    foreach ($array as $element)
        echo get_card($element);
}


function get_card($element)
{

    $trash =   '<span class="manage-trash">
                    <i class="far fa-trash-alt"></i>
                    <i class="fas fa-trash-alt"></i>
                    </span>';

    return "<div class='card mt-3 mx-1 col-md-3 manage-card'>
                    <div class='card-body  manage-tag-card'>
                        <span>$element</span>
                        $trash 
                    </div>
                </div> ";
}

?>

<link href="../../css/styles.css" rel="stylesheet">
<div class="manage-hero text-center my-bg-main-blue p-3">
    <h1 class="display-4 mt-5">Manage Categories</h1>
    <p class="lead my-3">Add or remove tags and courses</p>
</div>
<div class="d-flex flex-sm-row flex-column mx-2 my-3">
    <!-- Manage tags-->
    <div class="my-bg-black p-4 w-100 mx-1">
        <h2 class="display-5 mb-5 text-white">Tags</h2>
        <div class="container">
            <!-- Tags -->
            <div class="row">
                <?= display_cards($tags) ?>
            </div>
            <form class="card mt-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Insert a tag...">
                    <button class="btn my-bg-main-green">Add Tag</button>
                    </input>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage courses -->
    <div class="bg-light p-4 w-100 mx-1">
        <h2 class="display-5 mb-5">Courses</h2>
        <div class="container">
            <!-- Courses -->
            <class class="row">
                <?= display_cards($courses) ?>
            </class>
        </div>
        <form class="card mt-5">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Insert a course...">
                <button class="btn my-bg-main-green">Add Course</button>
                </input>
            </div>
        </form>
    </div>
</div>