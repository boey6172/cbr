
<div <?php echo "class='alert " . $vm->message_type . "'" ; ?> >
  <h3><?php echo $vm->message ; ?></h3>
  <input type="hidden" value=<?php echo $vm->user->user_id;?> id="user" />
</div>