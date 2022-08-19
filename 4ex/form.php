<!DOCTYPE html>

<html lang="ru">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание 4</title>
</head>
<body>
    <header>
        <div class="head">Задание 4</div>
    </header>
 
    <div class="content">
	    
        <form action="" method="POST">
		
	    <div class="point">
                <label>
                    Имя:<font color="red">*</font><br />
                    <input name="name" <?php if ($errors['name']) { print 'class="error"'; } ?> value="<?php print $values['name']; ?>" /><br />
		    <div class="error_message <?php if (!$errors['name']) { print 'hidden'; } ?>">
		        <?php if ($errors['name'] == 'empty') { print 'Введите имя.'; }
			      else { print 'Имя должно начинаться с заглавной буквы и может содержать только буквы и тире (не первым и не последним  символом).'; } ?>
		    </div>
            	</label>
	    </div><br />
		
	    <div class="point">
                <label>
                    e-mail:<font color="red">*</font><br />
                    <input name="email" <?php if ($errors['email']) { print 'class="error"'; } ?> value="<?php print $values['email']; ?>" /><br />
		    <div class="error_message <?php if (!$errors['email']) { print 'hidden'; } ?>">
		        <?php if ($errors['email'] == 'empty') { print 'Введите email.'; }
			      else { print 'email должен иметь вид email@example.com'; } ?>
		    </div>
                </label>
	    </div><br />
		
	    <div class="point">
                <label>
                    Дата рождения:<font color="red">*</font><br />
                    <input name="birthday" type="date" <?php if ($errors['birthday']) { print 'class="error"'; } ?> value="<?php print $values['birthday']; ?>" /><br />
		    <div class="error_message <?php if (!$errors['birthday']) { print 'hidden'; } ?>">
		        <?php if ($errors['birthday'] == 'empty') { print 'Введите дату рождения.'; }
			      else { print 'Дата рождения не может быть позже ' && print date('Y-m-d'); } ?>
		    </div>
                </label>
	    </div><br />
	    
	    <div class="point">
                Пол:<font color="red">*</font><br />
                <label>
                    <input type="radio" name="gender" value="Male" <?php if($values['gender'] == "Male"){ print "checked='checked'"; } ?> />Мужской
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" <?php if($values['gender'] == "Female"){ print "checked='checked'"; } ?> />Женский
                </label>
                <label>
                    <input type="radio" name="gender" value="other" <?php if($values['gender'] == "other"){ print "checked='checked'"; } ?> />Другое
                </label><br />
		<div class="error_message <?php if (!$errors['gender']) { print 'hidden'; } ?>">
		    Выберите пол.
		</div>
	    </div><br />
		
	    <div class="point">
                Количество конечностей:<font color="red">*</font><br />
                <label>
                    <input type="radio" name="limbs" value="2" <?php if($values['limbs'] == "2"){ print "checked='checked'"; } ?> />2
                </label>
                <label>
                    <input type="radio" name="limbs" value="4" <?php if($values['limbs'] == "4"){ print "checked='checked'"; } ?> />4
                </label>
                <label>
                    <input type="radio" name="limbs" value="other" <?php if($values['limbs'] == "other"){ print "checked='checked'"; } ?> />Другое
                </label><br />
		<div class="error_message <?php if (!$errors['limbs']) { print 'hidden'; } ?>">
		    Выберите количество конечностей.
		</div>
	    </div><br />
      
	    <div class="point">
                <label>
                    Сверхспособность:<font color="red">*</font><br />
                    <select name="superpowers[]" multiple="multiple">
                        <option value="Immortality" <?php if (in_array("Immortality", $values['superpowers'])) { print "selected='selected'";} ?>>Бессмертие</option>
                        <option value="Immateriality" <?php if (in_array("Immateriality", $values['superpowers'])) { print "selected='selected'";} ?>>Прохождение сквозь стены</option>
                        <option value="Levitation" <?php if (in_array("Levitation", $values['superpowers'])) { print "selected='selected'";} ?>>Левитация</option>
                    </select>
                </label><br />
		<div class="error_message <?php if (!$errors['superpowers']) { print 'hidden'; } ?>">
		    Выберите хотя бы одну сверхспособность.
		</div>
	    </div><br />
		
	    <div class="point">
                <label>
                    Биография:<font color="red">*</font><br />
                    <textarea name="biography" <?php if ($errors['biography']) { print 'class="error"'; } ?>><?php print $values['biography']; ?></textarea>
                </label><br />
		<div class="error_message <?php if (!$errors['biography']) { print 'hidden'; } ?>">
		    Расскажите о себе.
		</div>
	    </div><br />
		
	    <div class="point">
                <label>
                    <input type="checkbox" name="contract" <?php if ($values['contract']) { print "checked='checked'"; } ?> />С контрактом ознакомлен(а)<font color="red">*</font>
                </label><br />
		<div class="error_message <?php if (!$errors['contract']) { print 'hidden'; } ?>">
		    Примите соглашение.
		</div>
	    </div><br />
		
	    <div class="point">
                <input class="button" type="submit" value="Отправить" /><br />
		<div class="error_message <?php if (!$errors['save']) { print 'hidden'; } ?>">
		    Ошибка сохранения, попробуйте ещё раз.
		</div>
	    </div>
		
        </form>
          
    </div>
 
</body>
 
</html>
