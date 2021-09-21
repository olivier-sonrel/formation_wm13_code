<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $valid = 1;

    $order_no = sanitize_string($_POST['order_no']);
    $delivery_status = sanitize_string($_POST['delivery_status']);
    $delivery_note = sanitize_string($_POST['delivery_note']);

    if($delivery_status =='')
    {
        $valid = 0;
        $error_message .= 'You must have to select a delivery status<br>';
    }

    if($valid == 1)
    {
        $delivery_created = date('Y-m-d H:i:s A');

        $q = $pdo->prepare("INSERT INTO tbl_order_delivery (delivery_status,delivery_note,delivery_created,order_no) VALUES (?,?,?,?)");
        $q->execute([$delivery_status,$delivery_note,$delivery_created,$order_no]);


        // Send email to customer
        $q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=1");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $send_email_from = $row['send_email_from'];
            $receive_email_to = $row['receive_email_to'];
            $smtp_active = $row['smtp_active'];
            $smtp_ssl = $row['smtp_ssl'];
            $smtp_host = $row['smtp_host'];
            $smtp_port = $row['smtp_port'];
            $smtp_username = $row['smtp_username'];
            $smtp_password = $row['smtp_password'];
        }

        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
        $q->execute([9]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_subject = $row['et_subject'];
            $et_content = $row['et_content'];
        }

        $q = $pdo->prepare("SELECT * FROM tbl_order WHERE order_no=?");
        $q->execute([$order_no]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $customer_email = $row['customer_email'];
        }


        $message = str_replace('{{delivery_status}}', $delivery_status, $et_content);
        $message = str_replace('{{delivery_note}}', nl2br($delivery_note), $message);
        $message = str_replace('{{delivery_date_time}}', $delivery_created, $message);

        require_once('../mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        try {

            if($smtp_active == 'Yes')
            {
                if($smtp_ssl == 'Yes')
                {
                    $mail->SMTPSecure = "ssl";
                }
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host     = $smtp_host;
                $mail->Port     = $smtp_port;
                $mail->Username = $smtp_username;
                $mail->Password = $smtp_password;
            }
        
            $mail->addReplyTo($receive_email_to);
            $mail->setFrom($send_email_from);
            $mail->addAddress($customer_email);
            
            $mail->isHTML(true);
            $mail->Subject = $et_subject;
  
            $mail->Body = $message;
            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }


        $_SESSION['success_message'] = 'Delivery information is added successfully!';
        header('location: order-completed.php');
        exit;    
    }    
}

if(isset($_POST['form2']))
{
    $delivery_id = sanitize_string($_POST['delivery_id']);

    $statement = $pdo->prepare("DELETE FROM tbl_order_delivery WHERE delivery_id=?");
    $statement->execute([$delivery_id]);

    $_SESSION['success_message1'] = 'Delivery information is deleted successfully!';
    header('location: order-completed.php');
    exit;   
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Completed Orders</h4>
                <a href="order-pending.php" class="btn btn-primary btn-xs">Pending Orders</a>
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

                    if(isset($_SESSION['success_message'])):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($_SESSION['success_message']);
                        echo '</b></div></div>';
                        unset($_SESSION['success_message']);
                    endif;

                    if(isset($_SESSION['success_message1'])):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($_SESSION['success_message1']);
                        echo '</b></div></div>';
                        unset($_SESSION['success_message1']);
                    endif;
                    ?>

                    
                    <table id="d_table" class="text-left table w_100_p">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>SL</th>
                                <th>Customer Detail</th>
                                <th>Order Number</th>
                                <th>Paid Amount</th>
                                <th>Payment Method</th>
                                <th>Last Delivery Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $q = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_status=?");
                            $q->execute(['Completed']);
                            $result = $q->fetchAll();
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td>
                                        Type: <?php echo safe_data($row['customer_type']); ?><br>
                                        Name: <?php echo safe_data($row['customer_name']); ?><br>
                                        Email: <?php echo safe_data($row['customer_email']); ?>
                                    </td>
                                    <td><?php echo safe_data($row['order_no']); ?></td>
                                    <td>$<?php echo safe_data($row['paid_amount']); ?></td>
                                    <td><?php echo safe_data($row['payment_method']); ?></td>
                                    <td>
                                        <?php
                                        $r = $pdo->prepare("SELECT * FROM tbl_order_delivery WHERE order_no=? ORDER BY delivery_id DESC LIMIT 1");
                                        $r->execute([$row['order_no']]);
                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            echo safe_data($row1['delivery_status']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="order-detail.php?id=<?php echo safe_data($row['id']); ?>" class="dropdown-item"><i class="fa fa-eye"></i> Details</a>
                                            <a href="order-invoice.php?id=<?php echo safe_data($row['id']); ?>" class="dropdown-item"><i class="fa fa-life-ring"></i> Invoice</a>
                                            <a href="" class="dropdown-item" data-toggle="modal" data-target="#modd<?php echo safe_data($i); ?>"><i class="fa fa-external-link"></i> Delivery Info</a>
                                            <a href="order-completed-delete.php?id=<?php echo safe_data($row['id']); ?>" class="dropdown-item" onClick="return confirm('Are you sure?');"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                        <div class="modal fade" id="modd<?php echo safe_data($i); ?>">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold">Delivery Information</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="mb_10">Add Delivery Info</h5>
                                                        <form action="" method="post" class="mb_40">
                                                            <div class="form-group">
                                                                <select name="delivery_status" class="form-control select2" required>
                                                                    <option value="">Select Delivery Status</option>
                                                                    <option value="Received">Received</option>
                                                                    <option value="Processed">Processed</option>
                                                                    <option value="Shipped">Shipped</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Declined">Declined</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="order_no" value="<?php echo safe_data($row['order_no']); ?>">
                                                            <div class="form-group">
                                                                <textarea name="delivery_note" class="form-control h_100" cols="30" rows="10" placeholder="Write Delivery Note (Optional)"></textarea>
                                                            </div>
                                                            <div class="d-block mt-2">
                                                                <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Submit</button>
                                                            </div>
                                                        </form>
                                                        

                                                        <h5 class="mb_10">All Delivery Info</h5>
                                                        <table class="table">
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Delivery Status</th>
                                                                <th>Delivery Note</th>
                                                                <th>Delivery Date & Time</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            <?php
                                                            $r = $pdo->prepare("SELECT * FROM tbl_order_delivery WHERE order_no=? ORDER BY delivery_id ASC");
                                                            $r->execute([$row['order_no']]);
                                                            $res1 = $r->fetchAll();
                                                            foreach ($res1 as $row1) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo safe_data($i+1); ?></td>
                                                                    <td><?php echo safe_data($row1['delivery_status']); ?></td>
                                                                    <td><?php echo safe_data($row1['delivery_note']); ?></td>
                                                                    <td><?php echo safe_data($row1['delivery_created']); ?></td>
                                                                    <td>
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="delivery_id" value="<?php echo safe_data($row1['delivery_id']); ?>">
                                                                            <input type="submit" value="Delete" name="form2" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>