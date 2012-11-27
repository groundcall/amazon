<tr>
    <td><a href="<?php echo url('test/edit', array("id" => $user->getId()))?>"><?php echo $user->getId(); ?></a></td>
    <td><?php echo $user->getUsername(); ?></td>
    <td><?php echo $user->getCreatedAt()->format("Y-m-d H:i:s"); ?></td>
</tr>
