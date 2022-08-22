<?php
$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

$stmt=$db->query("SELECT * FROM posts");
$allposts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Read</title>
</head>

<body>
    <div class="page">
	<div class="topnav">
	    <a href="index.php">Diary</a>
	    <div class="topnav_right">
		<?php
		if (session_start() && empty($_SESSION['login'])) {
	            print '<a href="login.php">Log In</a>';  
		    print '<a href="logup.php">Log Up</a>';
		}
		else {
		    print '<a href="profile.php">Profile</a>'; 
		}
		?>
	    </div>
	</div>
        <div class="content">
            <div class="text">
                Here you can read other users.
            </div>
            <?php
            if (empty($allposts)) {
                print '<div class="description">No any notes.</div>';
            }
            else {
		$resposts = array_reverse($allposts);    
                foreach ($resposts as $post) {
                $stmt=$db->prepare("SELECT usr_id FROM posts WHERE post_id = ?");
                $stmt->execute([$post['post_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt=$db->prepare("SELECT usr_login FROM diary_users WHERE usr_id = ?");
                $stmt->execute([$user['usr_id']]);
                $autor = $stmt->fetch(PDO::FETCH_ASSOC);
                    print '<div class="description">';
                    print '<div class="name">';
		    print $autor['usr_login'];
		    print '</div><br>';
                    print $post['date'];
                    if ($post['up_date'] > $post['date']) {
                        print '<br>updated ';
                        print $post['up_date'];
                    }
                    print '<br><br>';
                    print $post['post'];
                    print '<br><br>'; ?>
                </div>
	      <?php
                }
            }
            ?>
        </div>
    	    
	
	<footer>
	    <a href="about.php">About</a>
	    <a href="contacts.php">Contacts</a>
	    <a href="rules.php">Rules</a>
	    <a href="admin.php">Are you admin?</a>
	<footer>
		    
    </div>

</body>
	
	
	
	
	
	<script src="/jquery/2.1.1/jquery.min.js"></script>
 
<script>
var block_show = false;
 
function scrollMore(){
	var $target = $('#showmore-triger');
	
	if (block_show) {
		return false;
	}
 
	var wt = $(window).scrollTop();
	var wh = $(window).height();
	var et = $target.offset().top;
	var eh = $target.outerHeight();
	var dh = $(document).height();   
 
	if (wt + wh >= et || wh + wt == dh || eh + et < wh){
		var page = $target.attr('data-page');	
		page++;
		block_show = true;
 
		$.ajax({ 
			url: '/ajax.php?page=' + page,  
			dataType: 'html',
			success: function(data){
				$('#showmore-list .prod-list').append(data);
				block_show = false;
			}
		});
 
		$target.attr('data-page', page);
		if (page ==  $target.attr('data-max')) {
			$target.remove();
		}
	}
}
 
$(window).scroll(function(){
	scrollMore();
});
	
$(document).ready(function(){ 
	scrollMore();
});
</script>

