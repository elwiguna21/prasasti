 <!-- ./Head -->
 <?php $this->load->view('partials/head'); ?>
 <!-- ./Head -->

 <body>
   <!-- ./Navbar -->
   <?php $this->load->view('partials/navbar'); ?>
   <!-- ./Navbar -->

   <div class="container mt-4 mb-4">
     <h3>
       <?= $judul ?>
       <hr>
     </h3>
     <div class="row">
       <div class="row">
         <?php
          foreach ($data as $data) { ?>

           <div class="post-slide mt-4">
             <div class="post-img">
               <a href="<?= base_url() ?>Front/<?= $judul ?>detail/<?= $data->slug ?>">
                 <img src="<?= base_url() ?>assets/upload/<?= $data->gambar ?>" alt="">
               </a>
             </div>
             <div class="post-review">
               <h3 class="post-title"><a href="<?= base_url() ?>Front/<?= $judul ?>detail/<?= $data->slug ?>"><?= $data->judul ?></a></h3>
               <ul class="post-bar">
                 <li><i class="fa fa-user"></i><a href="#">admin</a></li>
                 <li><i class="fa fa-calendar"></i><a href="#"><?= $data->tanggal ?></a></li>
               </ul>
               <p class="post-description"><?= substr($data->isi, 0, 100) ?></p>
             </div>
           </div>

         <?php } ?>
       </div>

     </div>
   </div>

   <!-- ./Footer -->
   <?php $this->load->view('partials/footer'); ?>
   <!-- ./Footer -->


   <style>
     .btn:focus,
     .btn:active,
     button:focus,
     button:active {
       outline: none !important;
       box-shadow: none !important;
     }

     #image-gallery .modal-footer {
       display: block;
     }

     .thumb {
       margin-top: 15px;
       margin-bottom: 15px;
     }
   </style>

   <script>
     let modalId = $('#image-gallery');

     $(document)
       .ready(function() {

         loadGallery(true, 'a.thumbnail');

         //This function disables buttons when needed
         function disableButtons(counter_max, counter_current) {
           $('#show-previous-image, #show-next-image')
             .show();
           if (counter_max === counter_current) {
             $('#show-next-image')
               .hide();
           } else if (counter_current === 1) {
             $('#show-previous-image')
               .hide();
           }
         }

         /**
          *
          * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
          * @param setClickAttr  Sets the attribute for the click handler.
          */

         function loadGallery(setIDs, setClickAttr) {
           let current_image,
             selector,
             counter = 0;

           $('#show-next-image, #show-previous-image')
             .click(function() {
               if ($(this)
                 .attr('id') === 'show-previous-image') {
                 current_image--;
               } else {
                 current_image++;
               }

               selector = $('[data-image-id="' + current_image + '"]');
               updateGallery(selector);
             });

           function updateGallery(selector) {
             let $sel = selector;
             current_image = $sel.data('image-id');
             $('#image-gallery-title')
               .text($sel.data('title'));
             $('#image-gallery-image')
               .attr('src', $sel.data('image'));
             disableButtons(counter, $sel.data('image-id'));
           }

           if (setIDs == true) {
             $('[data-image-id]')
               .each(function() {
                 counter++;
                 $(this)
                   .attr('data-image-id', counter);
               });
           }
           $(setClickAttr)
             .on('click', function() {
               updateGallery($(this));
             });
         }
       });

     // build key actions
     $(document)
       .keydown(function(e) {
         switch (e.which) {
           case 37: // left
             if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
               $('#show-previous-image')
                 .click();
             }
             break;

           case 39: // right
             if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
               $('#show-next-image')
                 .click();
             }
             break;

           default:
             return; // exit this handler for other keys
         }
         e.preventDefault(); // prevent the default action (scroll / move caret)
       });
   </script>
 </body>

 </html>