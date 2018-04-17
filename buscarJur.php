<?php require('inc/templates/header.php'); ?>
    <?php require('inc/functions/session.php'); ?>
  <?php require('inc/functions/querys.php'); ?>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="inc/functions/logout.php" class="Logout"><button type="button" class="btn btn-outline-danger">Cerrar sesión <i class="fas fa-sign-out-alt"></i></button></a>
    <?php endif ?>
    <div class="Concesionarios-contenedor">
<h3>Lista de concesionarios</h3>
<form method="GET" action="buscarJur.php?p=$_GET['p']&s=$_GET['s']&t=$_GET['t']" class="row">
    <div class="col-3"><input type="text" name="p" class="form-control" placeholder="Nombre..."></textarea></div>
    <div class="col-3"><input type="text" name="s" class="form-control" placeholder="Ap. Paterno..."></textarea></div>
    <div class="col-3"><input type="text" name="t" class="form-control" placeholder="Ap. Materno..."></textarea></div>
  <div class="col-1"><button type="submit" class="btn btn-secondary" name="fgevcv-buscar">Buscar</button></div>
  <div class="col-2"><button type="button" class="btn btn-secondary">Actualizar</button><br></br></div>
</form>
  <div class="Concesionarios-lista">
      <div class="row">
      <div class="col col-4">Concesionario</div>
      <div class="col col-1">Estatus</div>
      <div class="col col-4">Vehículo</div>
      <div class="col col-1">Estatus</div>
      <div class="col col-2">Acción</div>
    </div>
    <?php //if (isset($_GET['fgevcv-buscar'])): 
        $nombre = $_GET['p'];
        $apat = $_GET['s'];
        $amat = $_GET['t'];
        if ($nombre=="" and $apat=="" and $amat==""):?>
        <br>
          <div class="alert alert-danger" align="center">
                  <strong>No ha ingresado criterios para realizar la busqueda</strong>
              </div>
            <?php else:
        $consulta = buscarNombreJur($nombre, $apat, $amat);
        $res=count($consulta);
        // echo $res;
        $limit = 10;
        $adjacents = 1;
        $total_pages = ceil($res / $limit);
        if(isset($_GET['page']) && $_GET['page'] != "") {
            $page = $_GET['page'];            $offset = $limit * ($page-1);
        } else {
            $page = 1;
            $offset = 0;
        }
        if ($res!=0):
        $cons=buscarPaginacionJur($nombre,$apat,$amat,$offset,$limit);
        foreach ($cons as $res): ?>
        <div class="row">
            <div class="col col-4"><?php echo $res['nombre'].' '.$res['ap_pat'].' '.$res['ap_mat']; ?></div>
            <div class="col col-1"><?php //echo $resultado[''] ?></div>
            <!-- <div class="col col-3"><?php //echo $resultado[''] ?></div> -->
            <!-- <div class="col col-1"><?php //echo $resultado[''] ?></div> -->
            <div class="col col-4"><?php echo $res['placa']; ?></div>
            <div class="col col-1"><?php //echo $resultado[''] ?></div>
            <div class="col col-2"><a href="concesionario.php?idconcesion=<?php echo $res['idconcesion']; ?>"><button type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></button></a></div>
        </div> 
      <?php endforeach ?>
      <?php
       if($total_pages <= (1+($adjacents * 2))) {
          $start = 1;
          $end   = $total_pages;
       } else {
          if(($page - $adjacents) > 1) {               //Checking if the current page minus adjacent is greateer than one.
             if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
                $start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
                $end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
             } else {                         //If current page plus adjacents is greater than total pages.
                $start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
                $end   = $total_pages;                    //and the end will be the last page number that is total pages number.
             }
          } else {                            //If the current page minus adjacent is less than one.
             $start = 1;                                //then start will be start from page number 1
             $end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
          }
       }
       ?>
    </div>  
    <?php //echo $_GET['fgevcv-nombre']; ?> 
    <?php if($total_pages > 1) { ?>
       <ul class="pagination pagination justify-content-center">
          <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
             <a class='page-link' href="?page=1&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&lt;&lt;</a>
          </li>
          <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
             <a class='page-link' href="?page=<?php ($page>1 ? print($page-1) : print 1)?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&lt;</a>
          </li>
          <?php for($i=$start; $i<=$end; $i++) { ?>
          <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
             <a class='page-link' href="?page=<?php echo $i;?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>"><?php echo $i;?></a>
          </li>
          <?php } ?>
          <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
             <a class='page-link' href="?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&gt;</a>
          </li>
          <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
             <a class='page-link' href="?page=<?php echo $total_pages;?>&p=<?php echo $_GET['p']; ?>&s=<?php echo $_GET['s']; ?>&t=<?php echo $_GET['t']; ?>">&gt;&gt;</a>
          </li>
       </ul>
       <?php } ?>
      <?php else:?>
        <br>
        <div class="alert alert-danger" align="center">
                  <strong>No se encontraron registros</strong>
              </div>
      <?php endif ?>
    <?php //endif ?>
    </div>    
    <?php endif ?>
      <br><div class="col-1">
              <a href="lista-concesionarios.php"><button type="button" class="btn btn-secondary">Regresar</button></a>
        </div>