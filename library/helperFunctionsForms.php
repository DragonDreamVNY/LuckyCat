<?php
//helper functions. Dynamically generate a form using this function
function generateStudentEditForm($studID,$firstName,$lastName,$action) {
echo '<form class="edit" method="post" action="'.$action.'">';
echo '<div>';
echo '<h2>Edit Student ID: '.$studID.'</h2>';
echo '<table class="form">';
echo '<tr><td>';
echo '<label>';
// the following line uses the parameter to preset a value in the textfield. 
echo '<span>First Name</span><input name="studEditFirstName" type="text" value="'.$firstName.'">';
echo '<span>Last Name</span><input name="studEditLastName" type="text" value="'.$lastName.'">';
//echo '<span>Password</span><input name="lectPass1" type="password" >';
//echo '<span>Re-enter Password</span><input name="lectPass2" type="password" >';
echo '</label>';
echo '</td></tr>';
echo '<tr><td>';
echo '</td></tr>';
echo '<tr><td>';
echo '<label>';
echo '<span>Hit Enter to SAVE</span>';
//the next line has a button, used in view_ex01_edit_simple_select.php form
echo '<input name="btn_save" type="submit" id="btn_save" value="Save">';
echo '</label>';
echo '</td></tr>';
echo '</table>';
echo '</div>';
echo '</form>';

}



?>
