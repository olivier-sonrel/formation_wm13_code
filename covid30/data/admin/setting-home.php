<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form_meta_information']))
{
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    meta_title=?,
                    meta_description=?
                    WHERE id=?");
    $statement->execute([ 
                    $meta_title,
                    $meta_description,
                    1
                ]);
    $success_message = 'Home Page (Meta Information) Setting is updated successfully.';
}

if(isset($_POST['form_header']))
{
    $header_type = sanitize_string($_POST['header_type']);

    if($header_type == 'Image')
    {
        $header_type_image_heading = sanitize_string($_POST['header_type_image_heading']);
        $header_type_image_content = sanitize_string($_POST['header_type_image_content']);
        $header_type_image_btn_text = sanitize_string($_POST['header_type_image_btn_text']);
        $header_type_image_btn_url = sanitize_url($_POST['header_type_image_btn_url']);

        $current_header_image = sanitize_string($_POST['current_header_image']);

        $path = $_FILES['header_type_image_photo']['name'];
        $path_tmp = $_FILES['header_type_image_photo']['tmp_name'];

        $valid = 1;

        if($path != '')
        {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $path_tmp);
            if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
            {
                $valid = 0;
                $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
            }
        }

        if($valid == 1)
        {
            if($path == '') 
            {
                $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                        header_type=?,
                        header_type_image_heading=?,
                        header_type_image_content=?,
                        header_type_image_btn_text=?,
                        header_type_image_btn_url=?
                        WHERE id=?");
                $statement->execute([ 
                        $header_type,
                        $header_type_image_heading,
                        $header_type_image_content,
                        $header_type_image_btn_text,
                        $header_type_image_btn_url,
                        1
                    ]);
            }
            else
            {
                if($mime == 'image/jpeg')
                {
                    $ext = 'jpg';
                }
                elseif($mime == 'image/png')
                {
                    $ext = 'png';
                }
                elseif($mime == 'image/gif')
                {
                    $ext = 'gif';
                }

                unlink('../uploads/'.$current_header_image);

                $final_name = 'header_image'.'.'.$ext;
                move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

                $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                        header_type=?,
                        header_type_image_heading=?,
                        header_type_image_content=?,
                        header_type_image_btn_text=?,
                        header_type_image_btn_url=?,
                        header_type_image_photo=?
                        WHERE id=?");
                $statement->execute([ 
                        $header_type,
                        $header_type_image_heading,
                        $header_type_image_content,
                        $header_type_image_btn_text,
                        $header_type_image_btn_url,
                        $final_name,
                        1
                    ]);
            }
        }
    }

    elseif($header_type == 'Video')
    {
        $header_type_video_heading  = sanitize_string($_POST['header_type_video_heading']);
        $header_type_video_content  = sanitize_string($_POST['header_type_video_content']);
        $header_type_video_btn_text = sanitize_string($_POST['header_type_video_btn_text']);
        $header_type_video_btn_url  = sanitize_url($_POST['header_type_video_btn_url']);
        $header_type_video_yt_url   = sanitize_string($_POST['header_type_video_yt_url']);   

        $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                        header_type=?,
                        header_type_video_heading=?,
                        header_type_video_content=?,
                        header_type_video_btn_text=?,
                        header_type_video_btn_url=?,
                        header_type_video_yt_url=?
                        WHERE id=?");
        $statement->execute([ 
                        $header_type,
                        $header_type_video_heading,
                        $header_type_video_content,
                        $header_type_video_btn_text,
                        $header_type_video_btn_url,
                        $header_type_video_yt_url,
                        1
                    ]);
    }

    elseif($header_type == 'Slider')
    {
        $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                        header_type=?
                        WHERE id=?");
        $statement->execute([ 
                        $header_type,
                        1
                    ]);
    }
    
    $success_message = 'Home Page (Header) Setting is updated successfully.';
}

if(isset($_POST['form_symptom']))
{
    $symptom_title = sanitize_string($_POST['symptom_title']);
    $symptom_subtitle = sanitize_string($_POST['symptom_subtitle']);
    $symptom_status = sanitize_string($_POST['symptom_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    symptom_title=?,
                    symptom_subtitle=?,
                    symptom_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $symptom_title,
                    $symptom_subtitle,
                    $symptom_status,
                    1
                ]);
    $success_message = 'Home Page (Symptom) Setting is updated successfully.';
}

if(isset($_POST['form_special']))
{
    $special_title = sanitize_string($_POST['special_title']);
    $special_subtitle = sanitize_string($_POST['special_subtitle']);
    $special_content = sanitize_string($_POST['special_content']);
    $special_btn_text = sanitize_string($_POST['special_btn_text']);
    $special_btn_url = sanitize_url($_POST['special_btn_url']);
    $special_yt_video = sanitize_string($_POST['special_yt_video']);
    $special_status = sanitize_string($_POST['special_status']);

    $current_special_bg = sanitize_string($_POST['current_special_bg']);
    $current_special_video_bg = sanitize_string($_POST['current_special_video_bg']);

    $valid = 1;

    $path = $_FILES['special_bg']['name'];
    $path_tmp = $_FILES['special_bg']['tmp_name'];

    $path1 = $_FILES['special_video_bg']['name'];
    $path1_tmp = $_FILES['special_video_bg']['tmp_name'];

    if($path != '')
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for background<br>';
        }
    }

    if($path1 != '')
    {
        $finfo1 = finfo_open(FILEINFO_MIME_TYPE);
        $mime1 = finfo_file($finfo1, $path1_tmp);
        if( $mime1 != 'image/jpeg' && $mime1 != 'image/png' && $mime1 != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for video background<br>';
        }
    }

    if($valid == 1)
    {
        if($path == '' && $path1 == '')
        {
            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    special_title=?,
                    special_subtitle=?,
                    special_content=?,
                    special_btn_text=?,
                    special_btn_url=?,
                    special_yt_video=?,
                    special_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $special_title,
                    $special_subtitle,
                    $special_content,
                    $special_btn_text,
                    $special_btn_url,
                    $special_yt_video,
                    $special_status,
                    1
                ]);
        }
        elseif($path != '' && $path1 == '')
        {
            if($mime == 'image/jpeg') {$ext = 'jpg';}
            elseif($mime == 'image/png') {$ext = 'png';}
            elseif($mime == 'image/gif') {$ext = 'gif';}

            unlink('../uploads/'.$current_special_bg);

            $final_name = 'special_bg'.'.'.$ext;
            move_uploaded_file($path_tmp, '../uploads/'.$final_name);

            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    special_title=?,
                    special_subtitle=?,
                    special_content=?,
                    special_btn_text=?,
                    special_btn_url=?,
                    special_yt_video=?,
                    special_bg=?,
                    special_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $special_title,
                    $special_subtitle,
                    $special_content,
                    $special_btn_text,
                    $special_btn_url,
                    $special_yt_video,
                    $final_name,
                    $special_status,
                    1
                ]);
        }
        elseif($path == '' && $path1 != '')
        {

            if($mime1 == 'image/jpeg') {$ext1 = 'jpg';}
            elseif($mime1 == 'image/png') {$ext1 = 'png';}
            elseif($mime1 == 'image/gif') {$ext1 = 'gif';}

            unlink('../uploads/'.$current_special_video_bg);

            $final_name1 = 'special_video_bg'.'.'.$ext1;
            move_uploaded_file($path1_tmp, '../uploads/'.$final_name1);

            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    special_title=?,
                    special_subtitle=?,
                    special_content=?,
                    special_btn_text=?,
                    special_btn_url=?,
                    special_yt_video=?,
                    special_video_bg=?,
                    special_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $special_title,
                    $special_subtitle,
                    $special_content,
                    $special_btn_text,
                    $special_btn_url,
                    $special_yt_video,
                    $final_name1,
                    $special_status,
                    1
                ]);
        }
        elseif($path != '' && $path1 != '')
        {
            if($mime == 'image/jpeg') {$ext = 'jpg';}
            elseif($mime == 'image/png') {$ext = 'png';}
            elseif($mime == 'image/gif') {$ext = 'gif';}

            if($mime1 == 'image/jpeg') {$ext1 = 'jpg';}
            elseif($mime1 == 'image/png') {$ext1 = 'png';}
            elseif($mime1 == 'image/gif') {$ext1 = 'gif';}

            unlink('../uploads/'.$current_special_bg);
            unlink('../uploads/'.$current_special_video_bg);

            $final_name = 'special_bg'.'.'.$ext;
            move_uploaded_file($path_tmp, '../uploads/'.$final_name);

            $final_name1 = 'special_video_bg'.'.'.$ext1;
            move_uploaded_file($path1_tmp, '../uploads/'.$final_name1);

            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    special_title=?,
                    special_subtitle=?,
                    special_content=?,
                    special_btn_text=?,
                    special_btn_url=?,
                    special_yt_video=?,
                    special_bg=?,
                    special_video_bg=?,
                    special_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $special_title,
                    $special_subtitle,
                    $special_content,
                    $special_btn_text,
                    $special_btn_url,
                    $special_yt_video,
                    $final_name,
                    $final_name1,
                    $special_status,
                    1
                ]);
        }
        $success_message = 'Home Page (Special) Setting is updated successfully.';
    }
}


if(isset($_POST['form_prevention']))
{
    $prevention_title = sanitize_string($_POST['prevention_title']);
    $prevention_subtitle = sanitize_string($_POST['prevention_subtitle']);
    $prevention_status = sanitize_string($_POST['prevention_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    prevention_title=?,
                    prevention_subtitle=?,
                    prevention_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $prevention_title,
                    $prevention_subtitle,
                    $prevention_status,
                    1
                ]);
    $success_message = 'Home Page (Prevention) Setting is updated successfully.';
}


if(isset($_POST['form_doctor']))
{
    $doctor_title = sanitize_string($_POST['doctor_title']);
    $doctor_subtitle = sanitize_string($_POST['doctor_subtitle']);
    $doctor_status = sanitize_string($_POST['doctor_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    doctor_title=?,
                    doctor_subtitle=?,
                    doctor_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $doctor_title,
                    $doctor_subtitle,
                    $doctor_status,
                    1
                ]);
    $success_message = 'Home Page (Doctor) Setting is updated successfully.';
}


if(isset($_POST['form_appointment']))
{
    $appointment_title = sanitize_string($_POST['appointment_title']);
    $appointment_text = sanitize_string($_POST['appointment_text']);
    $appointment_btn_text = sanitize_string($_POST['appointment_btn_text']);
    $appointment_btn_url = sanitize_url($_POST['appointment_btn_url']);
    $appointment_status = sanitize_string($_POST['appointment_status']);

    $current_appointment_bg = sanitize_string($_POST['current_appointment_bg']);

    $valid = 1;

    $path = $_FILES['appointment_bg']['name'];
    $path_tmp = $_FILES['appointment_bg']['tmp_name'];

    if($path != '')
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for background<br>';
        }
    }

    if($valid == 1)
    {
        if($path == '')
        {
            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    appointment_title=?,
                    appointment_text=?,
                    appointment_btn_text=?,
                    appointment_btn_url=?,
                    appointment_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $appointment_title,
                    $appointment_text,
                    $appointment_btn_text,
                    $appointment_btn_url,
                    $appointment_status,
                    1
                ]);
        }
        else
        {
            if($mime == 'image/jpeg') {$ext = 'jpg';}
            elseif($mime == 'image/png') {$ext = 'png';}
            elseif($mime == 'image/gif') {$ext = 'gif';}

            unlink('../uploads/'.$current_appointment_bg);

            $final_name = 'appointment_bg'.'.'.$ext;
            move_uploaded_file($path_tmp, '../uploads/'.$final_name);

            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    appointment_title=?,
                    appointment_text=?,
                    appointment_btn_text=?,
                    appointment_btn_url=?,
                    appointment_bg=?,
                    appointment_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $appointment_title,
                    $appointment_text,
                    $appointment_btn_text,
                    $appointment_btn_url,
                    $final_name,
                    $appointment_status,
                    1
                ]);
        }
        $success_message = 'Home Page (Appointment) Setting is updated successfully.';
    }
}


if(isset($_POST['form_latest_news']))
{
    $latest_news_title = sanitize_string($_POST['latest_news_title']);
    $latest_news_subtitle = sanitize_string($_POST['latest_news_subtitle']);
    $latest_news_status = sanitize_string($_POST['latest_news_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    latest_news_title=?,
                    latest_news_subtitle=?,
                    latest_news_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $latest_news_title,
                    $latest_news_subtitle,
                    $latest_news_status,
                    1
                ]);
    $success_message = 'Home Page (Latest News) Setting is updated successfully.';
}


if(isset($_POST['form_newsletter']))
{
    $newsletter_title = sanitize_string($_POST['newsletter_title']);
    $newsletter_text = sanitize_string($_POST['newsletter_text']);
    $newsletter_status = sanitize_string($_POST['newsletter_status']);

    $current_newsletter_bg = sanitize_string($_POST['current_newsletter_bg']);

    $valid = 1;

    $path = $_FILES['newsletter_bg']['name'];
    $path_tmp = $_FILES['newsletter_bg']['tmp_name'];

    if($path != '')
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for background<br>';
        }
    }

    if($valid == 1)
    {
        if($path == '')
        {
            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    newsletter_title=?,
                    newsletter_text=?,
                    newsletter_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $newsletter_title,
                    $newsletter_text,
                    $newsletter_status,
                    1
                ]);
        }
        else
        {
            if($mime == 'image/jpeg') {$ext = 'jpg';}
            elseif($mime == 'image/png') {$ext = 'png';}
            elseif($mime == 'image/gif') {$ext = 'gif';}

            unlink('../uploads/'.$current_newsletter_bg);

            $final_name = 'newsletter_bg'.'.'.$ext;
            move_uploaded_file($path_tmp, '../uploads/'.$final_name);

            $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    newsletter_title=?,
                    newsletter_text=?,
                    newsletter_bg=?,
                    newsletter_status=?
                    WHERE id=?");
            $statement->execute([ 
                    $newsletter_title,
                    $newsletter_text,
                    $final_name,
                    $newsletter_status,
                    1
                ]);
        }
        $success_message = 'Home Page (Newsletter) Setting is updated successfully.';
    }
}



if(isset($_POST['form_outbreak']))
{
    $outbreak_title = sanitize_string($_POST['outbreak_title']);
    $outbreak_subtitle = sanitize_string($_POST['outbreak_subtitle']);
    $outbreak_status = sanitize_string($_POST['outbreak_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    outbreak_title=?,
                    outbreak_subtitle=?,
                    outbreak_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $outbreak_title,
                    $outbreak_subtitle,
                    $outbreak_status,
                    1
                ]);
    $success_message = 'Home Page (Outbreak) Setting is updated successfully.';
}


if(isset($_POST['form_outbreak_icon1']))
{
    $current_outbreak_icon1 = sanitize_string($_POST['current_outbreak_icon1']);

    $valid = 1;

    $path = $_FILES['outbreak_icon1']['name'];
    $path_tmp = $_FILES['outbreak_icon1']['tmp_name'];

    if($path == '') 
    {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }

    if($valid == 1)
    {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        unlink('../uploads/'.$current_outbreak_icon1);

        $final_name = 'outbreak_icon1'.'.'.$ext;
        move_uploaded_file($path_tmp, '../uploads/'.$final_name);

        $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                outbreak_icon1=?
                WHERE id=?");
        $statement->execute([ 
                $final_name,
                1
            ]);
        $success_message = 'Outbreak Icon 1 is updated successfully.';
    }
}


if(isset($_POST['form_outbreak_icon2']))
{
    $current_outbreak_icon2 = sanitize_string($_POST['current_outbreak_icon2']);

    $valid = 1;

    $path = $_FILES['outbreak_icon2']['name'];
    $path_tmp = $_FILES['outbreak_icon2']['tmp_name'];

    if($path == '') 
    {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }

    if($valid == 1)
    {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        unlink('../uploads/'.$current_outbreak_icon2);

        $final_name = 'outbreak_icon2'.'.'.$ext;
        move_uploaded_file($path_tmp, '../uploads/'.$final_name);

        $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                outbreak_icon2=?
                WHERE id=?");
        $statement->execute([ 
                $final_name,
                1
            ]);
        $success_message = 'Outbreak Icon 2 is updated successfully.';
    }
}


if(isset($_POST['form_outbreak_icon3']))
{
    $current_outbreak_icon3 = sanitize_string($_POST['current_outbreak_icon3']);

    $valid = 1;

    $path = $_FILES['outbreak_icon3']['name'];
    $path_tmp = $_FILES['outbreak_icon3']['tmp_name'];

    if($path == '') 
    {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }

    if($valid == 1)
    {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        unlink('../uploads/'.$current_outbreak_icon3);

        $final_name = 'outbreak_icon3'.'.'.$ext;
        move_uploaded_file($path_tmp, '../uploads/'.$final_name);

        $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                outbreak_icon3=?
                WHERE id=?");
        $statement->execute([ 
                $final_name,
                1
            ]);
        $success_message = 'Outbreak Icon 3 is updated successfully.';
    }
}


if(isset($_POST['form_countrywise']))
{
    $countrywise_title = sanitize_string($_POST['countrywise_title']);
    $countrywise_subtitle = sanitize_string($_POST['countrywise_subtitle']);
    $countrywise_status = sanitize_string($_POST['countrywise_status']);

    $statement = $pdo->prepare("UPDATE tbl_setting_home SET 
                    countrywise_title=?,
                    countrywise_subtitle=?,
                    countrywise_status=?
                    WHERE id=?");
    $statement->execute([ 
                    $countrywise_title,
                    $countrywise_subtitle,
                    $countrywise_status,
                    1
                ]);
    $success_message = 'Home Page (Countrywise) Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Home Page</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_home WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {

    $meta_title                 = $row['meta_title'];
    $meta_description           = $row['meta_description'];

    $header_type                = $row['header_type'];
    
    $header_type_image_heading  = $row['header_type_image_heading'];
    $header_type_image_content  = $row['header_type_image_content'];
    $header_type_image_btn_text = $row['header_type_image_btn_text'];
    $header_type_image_btn_url  = $row['header_type_image_btn_url'];
    $header_type_image_photo    = $row['header_type_image_photo'];
    
    $header_type_video_heading  = $row['header_type_video_heading'];
    $header_type_video_content  = $row['header_type_video_content'];
    $header_type_video_btn_text = $row['header_type_video_btn_text'];
    $header_type_video_btn_url  = $row['header_type_video_btn_url'];
    $header_type_video_yt_url   = $row['header_type_video_yt_url'];
    
    $symptom_title              = $row['symptom_title'];
    $symptom_subtitle           = $row['symptom_subtitle'];
    $symptom_status             = $row['symptom_status'];
    
    $special_title              = $row['special_title'];
    $special_subtitle           = $row['special_subtitle'];
    $special_content            = $row['special_content'];
    $special_btn_text           = $row['special_btn_text'];
    $special_btn_url            = $row['special_btn_url'];
    $special_yt_video           = $row['special_yt_video'];
    $special_bg                 = $row['special_bg'];
    $special_video_bg           = $row['special_video_bg'];
    $special_status             = $row['special_status'];

    $prevention_title           = $row['prevention_title'];
    $prevention_subtitle        = $row['prevention_subtitle'];
    $prevention_status          = $row['prevention_status'];

    $doctor_title               = $row['doctor_title'];
    $doctor_subtitle            = $row['doctor_subtitle'];
    $doctor_status              = $row['doctor_status'];

    $appointment_title          = $row['appointment_title'];
    $appointment_text           = $row['appointment_text'];
    $appointment_btn_text       = $row['appointment_btn_text'];
    $appointment_btn_url        = $row['appointment_btn_url'];
    $appointment_bg             = $row['appointment_bg'];
    $appointment_status         = $row['appointment_status'];

    $latest_news_title          = $row['latest_news_title'];
    $latest_news_subtitle       = $row['latest_news_subtitle'];
    $latest_news_status         = $row['latest_news_status'];

    $newsletter_title           = $row['newsletter_title'];
    $newsletter_text            = $row['newsletter_text'];
    $newsletter_bg              = $row['newsletter_bg'];
    $newsletter_status          = $row['newsletter_status'];

    $outbreak_title             = $row['outbreak_title'];
    $outbreak_subtitle          = $row['outbreak_subtitle'];
    $outbreak_status            = $row['outbreak_status'];

    $outbreak_icon1             = $row['outbreak_icon1'];
    $outbreak_icon2             = $row['outbreak_icon2'];
    $outbreak_icon3             = $row['outbreak_icon3'];

    $countrywise_title          = $row['countrywise_title'];
    $countrywise_subtitle       = $row['countrywise_subtitle'];
    $countrywise_status         = $row['countrywise_status'];
}
?>


<div class="main-content-inner">
    <div class="row">

        
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">

                    <?php
                    if( (isset($error_message)) && ($error_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger" role="alert"><b>';
                        echo safe_data($error_message);
                        echo '</b></div></div>';
                    endif;

                    if( (isset($success_message)) && ($success_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($success_message);
                        echo '</b></div></div>';
                    endif;
                    ?>

                    <div class="d-md-flex arf-vertical-tab">

                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            
                            <a class="nav-link active" id="v-pills-tab-0" data-toggle="pill" href="#v-pills-t-0" role="tab" aria-controls="v-pills-t-0" aria-selected="true">
                                Meta Information
                            </a>

                            <a class="nav-link" id="v-pills-tab-1" data-toggle="pill" href="#v-pills-t-1" role="tab" aria-controls="v-pills-t-1" aria-selected="false">
                                Header Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-11" data-toggle="pill" href="#v-pills-t-11" role="tab" aria-controls="v-pills-t-11" aria-selected="false">
                                Outbreak Statistics
                            </a>

                            <a class="nav-link" id="v-pills-tab-12" data-toggle="pill" href="#v-pills-t-12" role="tab" aria-controls="v-pills-t-12" aria-selected="false">
                                Countrywise Statistics
                            </a>

                            <a class="nav-link" id="v-pills-tab-2" data-toggle="pill" href="#v-pills-t-2" role="tab" aria-controls="v-pills-t-2" aria-selected="false">
                                Symptom Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-3" data-toggle="pill" href="#v-pills-t-3" role="tab" aria-controls="v-pills-t-3" aria-selected="false">
                                Special Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-4" data-toggle="pill" href="#v-pills-t-4" role="tab" aria-controls="v-pills-t-4" aria-selected="false">
                                Prevention Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-5" data-toggle="pill" href="#v-pills-t-5" role="tab" aria-controls="v-pills-t-5" aria-selected="false">
                                Doctor Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-6" data-toggle="pill" href="#v-pills-t-6" role="tab" aria-controls="v-pills-t-6" aria-selected="false">
                                Appointment Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-7" data-toggle="pill" href="#v-pills-t-7" role="tab" aria-controls="v-pills-t-7" aria-selected="false">
                                Latest News Section
                            </a>

                            <a class="nav-link" id="v-pills-tab-8" data-toggle="pill" href="#v-pills-t-8" role="tab" aria-controls="v-pills-t-8" aria-selected="false">
                                Newsletter Section
                            </a>

                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-t-0" role="tabpanel" aria-labelledby="v-pills-tab-0">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_meta_information">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-1" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_header_image" value="<?php echo safe_data($header_type_image_photo); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Header Type</b></label>
                                        <div class="d-block">
                                            <select name="header_type" class="form-control select2" onChange="showContent(this)">
                                                <option value="Slider" <?php if($header_type=='Slider') {echo 'selected';} ?>>Slider</option>
                                                <option value="Image" <?php if($header_type=='Image') {echo 'selected';} ?>>Image</option>
                                                <option value="Video" <?php if($header_type=='Video') {echo 'selected';} ?>>Video</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="showImageContent">
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Heading</b></label>
                                            <input type="text" name="header_type_image_heading" class="form-control" value="<?php echo safe_data($header_type_image_heading); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Content</b></label>
                                            <textarea name="header_type_image_content" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($header_type_image_content); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Button Text</b></label>
                                            <input type="text" name="header_type_image_btn_text" class="form-control" value="<?php echo safe_data($header_type_image_btn_text); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Button URL</b></label>
                                            <input type="text" name="header_type_image_btn_url" class="form-control" value="<?php echo safe_data($header_type_image_btn_url); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                                            <div class="d-block">
                                                <img src="../uploads/<?php echo safe_data($header_type_image_photo); ?>" class="w_300">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                                            <div class="d-block">
                                                <input type="file" name="header_type_image_photo">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="showVideoContent">
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Heading</b></label>
                                            <input type="text" name="header_type_video_heading" class="form-control" value="<?php echo safe_data($header_type_video_heading); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Content</b></label>
                                            <textarea name="header_type_video_content" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($header_type_video_content); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Button Text</b></label>
                                            <input type="text" name="header_type_video_btn_text" class="form-control" value="<?php echo safe_data($header_type_video_btn_text); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Button URL</b></label>
                                            <input type="text" name="header_type_video_btn_url" class="form-control" value="<?php echo safe_data($header_type_video_btn_url); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">YouTube Video URL</b></label>
                                            <input type="text" name="header_type_video_yt_url" class="form-control" value="<?php echo safe_data($header_type_video_yt_url); ?>">
                                        </div>
                                    </div>

                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_header">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-11" role="tabpanel" aria-labelledby="v-pills-tab-11">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="outbreak_title" class="form-control" value="<?php echo safe_data($outbreak_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="outbreak_subtitle" class="form-control" value="<?php echo safe_data($outbreak_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="outbreak_status" class="form-control select2">
                                                <option value="Show" <?php if($outbreak_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($outbreak_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_outbreak">Update</button>
                                    </div>
                                </form>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="hline">Outbreak Icon 1</h3>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="current_outbreak_icon1" value="<?php echo safe_data($outbreak_icon1); ?>">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Existing Icon</b></label>
                                                <div class="d-block">
                                                    <img src="../uploads/<?php echo safe_data($outbreak_icon1); ?>" class="w_100">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Change Icon</b></label>
                                                <div class="d-block">
                                                    <input type="file" name="outbreak_icon1">
                                                </div>
                                            </div>
                                            <div class="d-block mt-2">
                                                <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_outbreak_icon1">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="hline">Outbreak Icon 2</h3>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="current_outbreak_icon2" value="<?php echo safe_data($outbreak_icon2); ?>">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Existing Icon</b></label>
                                                <div class="d-block">
                                                    <img src="../uploads/<?php echo safe_data($outbreak_icon2); ?>" class="w_100">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Change Icon</b></label>
                                                <div class="d-block">
                                                    <input type="file" name="outbreak_icon2">
                                                </div>
                                            </div>
                                            <div class="d-block mt-2">
                                                <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_outbreak_icon2">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="hline">Outbreak Icon 3</h3>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="current_outbreak_icon3" value="<?php echo safe_data($outbreak_icon3); ?>">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Existing Icon</b></label>
                                                <div class="d-block">
                                                    <img src="../uploads/<?php echo safe_data($outbreak_icon3); ?>" class="w_100">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Change Icon</b></label>
                                                <div class="d-block">
                                                    <input type="file" name="outbreak_icon3">
                                                </div>
                                            </div>
                                            <div class="d-block mt-2">
                                                <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_outbreak_icon3">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                


                                




                            </div>



                            <div class="tab-pane fade" id="v-pills-t-12" role="tabpanel" aria-labelledby="v-pills-tab-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="countrywise_title" class="form-control" value="<?php echo safe_data($countrywise_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="countrywise_subtitle" class="form-control" value="<?php echo safe_data($countrywise_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="countrywise_status" class="form-control select2">
                                                <option value="Show" <?php if($countrywise_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($countrywise_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_countrywise">Update</button>
                                    </div>
                                </form>
                            </div>





                            <div class="tab-pane fade" id="v-pills-t-2" role="tabpanel" aria-labelledby="v-pills-tab-2">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="symptom_title" class="form-control" value="<?php echo safe_data($symptom_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="symptom_subtitle" class="form-control" value="<?php echo safe_data($symptom_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="symptom_status" class="form-control select2">
                                                <option value="Show" <?php if($symptom_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($symptom_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_symptom">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-3" role="tabpanel" aria-labelledby="v-pills-tab-3">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_special_bg" value="<?php echo safe_data($special_bg); ?>">
                                    <input type="hidden" name="current_special_video_bg" value="<?php echo safe_data($special_video_bg); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="special_title" class="form-control" value="<?php echo safe_data($special_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="special_subtitle" class="form-control" value="<?php echo safe_data($special_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Content</b></label>
                                        <textarea name="special_content" class="form-control h_200" cols="30" rows="10"><?php echo safe_data($special_content); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button Text</b></label>
                                        <input type="text" name="special_btn_text" class="form-control" value="<?php echo safe_data($special_btn_text); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button URL</b></label>
                                        <input type="text" name="special_btn_url" class="form-control" value="<?php echo safe_data($special_btn_url); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">YouTube Video</b></label>
                                        <input type="text" name="special_yt_video" class="form-control" value="<?php echo safe_data($special_yt_video); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Background</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($special_bg); ?>" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Background</b></label>
                                        <div class="d-block">
                                            <input type="file" name="special_bg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Video Background</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($special_video_bg); ?>" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Video Background</b></label>
                                        <div class="d-block">
                                            <input type="file" name="special_video_bg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="special_status" class="form-control select2">
                                                <option value="Show" <?php if($special_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($special_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_special">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-4" role="tabpanel" aria-labelledby="v-pills-tab-4">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="prevention_title" class="form-control" value="<?php echo safe_data($prevention_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="prevention_subtitle" class="form-control" value="<?php echo safe_data($prevention_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="prevention_status" class="form-control select2">
                                                <option value="Show" <?php if($prevention_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($prevention_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_prevention">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-5" role="tabpanel" aria-labelledby="v-pills-tab-5">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="doctor_title" class="form-control" value="<?php echo safe_data($doctor_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="doctor_subtitle" class="form-control" value="<?php echo safe_data($doctor_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="doctor_status" class="form-control select2">
                                                <option value="Show" <?php if($doctor_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($doctor_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_doctor">Update</button>
                                    </div>
                                </form>
                            </div>




                            <div class="tab-pane fade" id="v-pills-t-6" role="tabpanel" aria-labelledby="v-pills-tab-6">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_appointment_bg" value="<?php echo safe_data($appointment_bg); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="appointment_title" class="form-control" value="<?php echo safe_data($appointment_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Text</b></label>
                                        <textarea name="appointment_text" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($appointment_text); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button Text</b></label>
                                        <input type="text" name="appointment_btn_text" class="form-control" value="<?php echo safe_data($appointment_btn_text); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button URL</b></label>
                                        <input type="text" name="appointment_btn_url" class="form-control" value="<?php echo safe_data($appointment_btn_url); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Background</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($appointment_bg); ?>" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Background</b></label>
                                        <div class="d-block">
                                            <input type="file" name="appointment_bg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="appointment_status" class="form-control select2">
                                                <option value="Show" <?php if($appointment_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($appointment_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_appointment">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-7" role="tabpanel" aria-labelledby="v-pills-tab-7">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="latest_news_title" class="form-control" value="<?php echo safe_data($latest_news_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <input type="text" name="latest_news_subtitle" class="form-control" value="<?php echo safe_data($latest_news_subtitle); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="latest_news_status" class="form-control select2">
                                                <option value="Show" <?php if($latest_news_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($latest_news_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_latest_news">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-8" role="tabpanel" aria-labelledby="v-pills-tab-8">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_newsletter_bg" value="<?php echo safe_data($newsletter_bg); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Title</b></label>
                                        <input type="text" name="newsletter_title" class="form-control" value="<?php echo safe_data($newsletter_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Text</b></label>
                                        <textarea name="newsletter_text" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($newsletter_text); ?></textarea>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Background</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($newsletter_bg); ?>" class="w_300">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Background</b></label>
                                        <div class="d-block">
                                            <input type="file" name="newsletter_bg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Show or Hide?</b></label>
                                        <div class="d-block">
                                            <select name="newsletter_status" class="form-control select2">
                                                <option value="Show" <?php if($newsletter_status=='Show') {echo 'selected';} ?>>Show</option>
                                                <option value="Hide" <?php if($newsletter_status=='Hide') {echo 'selected';} ?>>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_newsletter">Update</button>
                                    </div>
                                </form>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>