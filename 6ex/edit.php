<!DOCTYPE html>
<html lang="">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./styles.css" />
  <title>Обновление данных</title>
</head>

<body>
  
  <div class="content">
    
    <form method="POST" action="">
      
      <label>
          Имя:<br>
          <input name="name" value="<?php print $values['name']; ?>" /><br>
      </label><br>
      
      <label>
          e-mail:<br>
          <input name="email" value="<?php print $values['email']; ?>" /><br>
      </label><br>
      
      <label>
          Дата рождения:<br>
          <input name="birthday" value="<?php print $values['birthday']; ?>" /><br>
      </label><br>
      
      Пол:<br>
      <label>
          <input type="radio" name="gender" value="Male" <?php if($values['gender'] == "Male"){ print "checked='checked'"; } ?> />Мужской
      </label>
      <label>
          <input type="radio" name="gender" value="Female" <?php if($values['gender'] == "Female"){ print "checked='checked'"; } ?> />Женский
      </label>
      <label>
          <input type="radio" name="gender" value="other" <?php if($values['gender'] == "other"){ print "checked='checked'"; } ?> />Другое
      </label><br>
  
      Количество конечностей:<br>
      <label>
          <input type="radio" name="limbs" value="2" <?php if($values['limbs'] == "2"){ print "checked='checked'"; } ?> />2
      </label>
      <label>
          <input type="radio" name="limbs" value="4" <?php if($values['limbs'] == "4"){ print "checked='checked'"; } ?> />4
      </label>
      <label>
          <input type="radio" name="limbs" value="other" <?php if($values['limbs'] == "other"){ print "checked='checked'"; } ?> />Другое
      </label><br>
  
      <label>
          Сверхспособность:<br>
          <select name="superpowers[]" multiple="multiple">
              <option value="Immortality" <?php if (in_array("Immortality", $values['superpowers'])) { print "selected='selected'";} ?>>Бессмертие</option>
              <option value="Immateriality" <?php if (in_array("Immateriality", $values['superpowers'])) { print "selected='selected'";} ?>>Прохождение сквозь стены</option>
              <option value="Levitation" <?php if (in_array("Levitation", $values['superpowers'])) { print "selected='selected'";} ?>>Левитация</option>
          </select>
      </label><br>
  
      <label>
          Биография:<br>
          <textarea name="biography"><?php print $values['biography']; ?></textarea>
      </label><br>
      
      <input class="button" type="submit" value="Отправить" /><br>
      
    </form>
    
  </div>
  
</body>

</html>
