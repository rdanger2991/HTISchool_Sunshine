 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="../index.php" class="brand-link">
     <img src="../dist/img/a.PNG" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">AdminLTE 3</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Alexander Pierce</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

         <li class="nav-item">
           <a href="../index.php" class="nav-link">
             <i class="nav-icon fas fa-th"></i>
             <p>
               ACCUEIL
               <span class="right badge badge-primary">ACCUEIL</span>
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-copy"></i>
             <p>
               CLASSE
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../classes/classe.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER CLASSE</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-chart-pie"></i>
             <p>
               ELEVES
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../inscriptions/inscription.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER ELEVES</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-tree"></i>
             <p>
               MATIERES
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../matieres/cate_matiere.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>CATEGORIE MATIERE</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../matieres/matiere.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUETR MATIERES</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-edit"></i>
             <p>
               PROFFESSEUR
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../forms/general.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER PROFESSEUR</p>
               </a>
             </li>
           </ul>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-table"></i>
             <p>
               BOURSE
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../bourses/type_de_bourse.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER TYPE DE BOURSE</p>
               </a>
             </li>
           </ul>

           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../bourses/bourse.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER BOURSE</p>
               </a>
             </li>
           </ul>

         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon far fa-envelope"></i>
             <p>
               NOTES
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">

             <li class="nav-item">
               <a href="../frequences/cat_freq.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>CATEGORIE FREQUENCE</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../frequences/frequence.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>FREQUENCE</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../notes/note_form.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER NOTES</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../notes/liste_des_notes.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>LISTE NOTES</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../mailbox/read-mail.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>BULLETIN</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../mailbox/read-mail.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>RELEVE NOTES</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               PAIEMENT
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../paiements/paiement_modalite_type.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>TYPE DE MODALITE</p>
               </a>
             </li>
           </ul>

           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../paiements/paiement_add_modalite.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>MODALITE</p>
               </a>
             </li>
           </ul>

           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../paiements/paiement.php" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER PAIEMENT</p>
               </a>
             </li>
           </ul>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               LISTE
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../examples/invoice.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>LISTE DE FORMATION</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="../examples/invoice.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>LISTE DE DECISION</p>
               </a>
             </li>
           </ul>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               DOCUMENT
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../examples/invoice.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>..............</p>
               </a>
             </li>

           </ul>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               EMPLOIE DE TEMPS
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../examples/invoice.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>PLANIFICATION DES HORAIRES</p>
               </a>
             </li>
           </ul>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               PARAMETRE DE SECURITE
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="../examples/invoice.html" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>AJOUTER UTILISATEUR</p>
               </a>
             </li>
           </ul>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>