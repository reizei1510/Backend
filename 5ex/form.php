<!DOCTYPE html>

<html lang="ru">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание 5</title>
</head>
<body>
    <div class="topnav">
        <a href="index.php">Задание 5</a>
        <div class="topnav_right">
            <?php if (empty($_SESSION['login'])) { ?>
		<a href="login.php" >Войти</a>
            <?php } else { ?>
		<a href="login.php" >Выйти</a>
	    <?php } ?>
        </div>
    </div>
 
    <div class="content">
	    
	<div class="point data_message"><?php print $messages['data']; ?></div><br>
	
	<div class="point">
		
            <form action="" method="POST">
	    
                <label>
                    Имя:<font color="red">*</font><br>
                    <input name="name" <?php if ($errors['name']) { print 'class="error"'; } ?> value="<?php print $values['name']; ?>" /><br>
		    <div class="error_message"><?php print $messages['name']; ?></div>
            	</label><br>
	
                <label>
                    e-mail:<font color="red">*</font><br>
                    <input name="email" <?php if ($errors['email']) { print 'class="error"'; } ?> value="<?php print $values['email']; ?>" /><br>
		    <div class="error_message"><?php print $messages['email']; ?></div>
                </label><br>
		
                <label>
                    Дата рождения:<font color="red">*</font><br>
                    <input name="birthday" type="date" <?php if ($errors['birthday']) { print 'class="error"'; } ?> value="<?php print $values['birthday']; ?>" /><br>
		    <div class="error_message"><?php print $messages['birthday']; ?></div>
                </label><br>
	    
                Пол:<font color="red">*</font><br>
                <label>
                    <input type="radio" name="gender" value="Male" <?php if($values['gender'] == "Male"){ print "checked='checked'"; } ?> />Мужской
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" <?php if($values['gender'] == "Female"){ print "checked='checked'"; } ?> />Женский
                </label>
                <label>
                    <input type="radio" name="gender" value="other" <?php if($values['gender'] == "other"){ print "checked='checked'"; } ?> />Другое
                </label><br>
		<div class="error_message"><?php print $messages['gender']; ?></div><br>
		
                Количество конечностей:<font color="red">*</font><br>
                <label>
                    <input type="radio" name="limbs" value="2" <?php if($values['limbs'] == "2"){ print "checked='checked'"; } ?> />2
                </label>
                <label>
                    <input type="radio" name="limbs" value="4" <?php if($values['limbs'] == "4"){ print "checked='checked'"; } ?> />4
                </label>
                <label>
                    <input type="radio" name="limbs" value="other" <?php if($values['limbs'] == "other"){ print "checked='checked'"; } ?> />Другое
                </label><br>
		<div class="error_message"><?php print $messages['limbs']; ?></div><br>
      
                <label>
                    Сверхспособность:<font color="red">*</font><br>
                    <select name="superpowers[]" multiple="multiple" <?php if ($errors['superpowers']) { print 'class="error"'; } ?> >
                        <option value="Immortality" <?php if (in_array("Immortality", $values['superpowers'])) { print "selected='selected'";} ?>>Бессмертие</option>
                        <option value="Immateriality" <?php if (in_array("Immateriality", $values['superpowers'])) { print "selected='selected'";} ?>>Прохождение сквозь стены</option>
                        <option value="Levitation" <?php if (in_array("Levitation", $values['superpowers'])) { print "selected='selected'";} ?>>Левитация</option>
                    </select>
                </label><br>
		<div class="error_message"><?php print $messages['superpowers']; ?></div><br>
		
                <label>
                    Биография:<font color="red">*</font><br>
                    <textarea name="biography" <?php if ($errors['biography']) { print 'class="error"'; } ?>><?php print $values['biography']; ?></textarea>
                </label><br>
		<div class="error_message"><?php print $messages['biography']; ?></div><br>
		
                <label>
                    <input type="checkbox" name="contract" <?php if ($values['contract']) { print "checked='checked'"; } ?> />С контрактом ознакомлен(а)<font color="red">*</font>
                </label><br>
		<div class="error_message"><?php print $messages['contract']; ?></div><br>
		
                <input class="button" type="submit" value="Отправить" /><br>
		<div class="error_message"><?php print $messages['save']; ?></div>
	
	    </form>    
		
	</div>
        
    </div>
 
</body>
 
</html>
