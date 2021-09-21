<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $news_title         = sanitize_string($_POST['news_title']);
    $news_slug          = sanitize_string($_POST['news_slug']);
    $news_content       = sanitize_ckeditor($_POST['news_content']);
    $news_content_short = sanitize_string($_POST['news_content_short']);
    $category_id        = sanitize_int($_POST['category_id']);
    $news_order         = sanitize_int($_POST['news_order']);
    $news_status        = sanitize_string($_POST['news_status']);
    $meta_title         = sanitize_string($_POST['meta_title']);
    $meta_description   = sanitize_string($_POST['meta_description']);
    
    $valid = 1;

    if($news_title == '')
    {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    if($news_content == '')
    {
        $valid = 0;
        $error_message .= 'Content can not be empty<br>';
    }

    if($news_content_short == '')
    {
        $valid = 0;
        $error_message .= 'Short Content can not be empty<br>';
    }

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

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

        $news_date = date('Y-m-d');

        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_news'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $ai_id=$row[10];
        }

        if($news_slug == '') {
            $temp_string = strtolower($news_title);
            $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        } else {
            $temp_string = strtolower($news_slug);
            $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        $final_name = 'news-'.$ai_id.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );
    
        $statement = $pdo->prepare("INSERT INTO tbl_news (
                            news_title,
                            news_slug,
                            news_content,
                            news_content_short,
                            news_date,
                            photo,
                            category_id,
                            news_order,
                            news_status,
                            meta_title,
                            meta_description
                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                            $news_title,
                            $news_slug,
                            $news_content,
                            $news_content_short,
                            $news_date,
                            $final_name,
                            $category_id,
                            $news_order,
                            $news_status,
                            $meta_title,
                            $meta_description
                        ));

        // Send email to all active subscribers
        $q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=?");
        $q->execute([1]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $send_email_from = $row['send_email_from'];
            $receive_email_to = $row['receive_email_to'];
            $smtp_active = $row['smtp_active'];
            $smtp_ssl = $row['smtp_ssl'];
            $smtp_host = $row['smtp_host'];
            $smtp_port = $row['smtp_port'];
            $smtp_username = $row['smtp_username'];
            $smtp_password = $row['smtp_password'];
        }

        require_once('../mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
        $q->execute([4]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_subject = $row['et_subject'];
            $et_content = $row['et_content'];
        }

        try {

            if($smtp_active == 'Yes')
            {
                if($smtp_ssl == 'Yes')
                {
                    $mail->SMTPSecure = "ssl";
                }
                $mail->IsSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = $smtp_host;
                $mail->Port       = $smtp_port;
                $mail->Username   = $smtp_username;
                $mail->Password   = $smtp_password;
            }
       
            $mail->addReplyTo($receive_email_to);
            $mail->setFrom($send_email_from);
            
            $mail->isHTML(true);
            $mail->Subject = $et_subject;

            $q = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_active=?");
            $q->execute([1]);
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $mail2 = clone $mail;
                $subs_email = $row['subs_email'];

                $post_link = '<a href="'.BASE_URL.'news/'.$news_slug.'">'.BASE_URL.'news/'.$news_slug.'</a>';

                $message = str_replace('{{post_link}}', $post_link, $et_content);

                $mail2->MsgHTML($message);
                $mail2->addAddress($subs_email);
                $mail2->send();
            }

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
            
        $success_message = 'News is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add News</h4>
                <a href="news.php" class="btn btn-primary btn-xs">View News</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


<div class="main-content-inner">
    <div class="row">

        <div class="col-12 mt-5">
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

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Title *</b></label>
                            <input type="text" class="form-control" name="news_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Slug</b></label>
                            <input type="text" class="form-control" name="news_slug">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Content *</b></label>
                            <textarea class="form-control editor" name="news_content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Short Content *</b></label>
                            <textarea class="form-control h_100" name="news_content_short"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Photo *</b></label>
                            <div class="d-block">
                                <input type="file" name="photo"><br>
                                <span class="text-danger">(Only jpg, jpeg, gif and png are allowed)</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Select Category</b></label>
                            <div class="d-block">
                                <select name="category_id" class="form-control select2">
                                    <?php
                                    $q = $pdo->prepare("SELECT * FROM tbl_category WHERE category_status=? ORDER BY category_order ASC");
                                    $q->execute(['Active']);
                                    $res = $q->fetchAll();
                                    foreach ($res as $row) {
                                        ?><option value="<?php echo safe_data($row['category_id']); ?>"><?php echo safe_data($row['category_name']); ?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="news_order">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="news_status" class="form-control select2">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Title</b></label>
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Description</b></label>
                            <textarea class="form-control h_100" name="meta_description"></textarea>
                        </div>
                        
                        
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>