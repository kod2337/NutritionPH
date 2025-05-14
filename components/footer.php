<footer class="footer">

   <section class="grid">

      <div class="box">
         <img src="images/email-icon.png" alt="">
         <h3>our email</h3>
         <a href="mailto:NourishedPH@gmail.com">NourishedPH@gmail.com</a>
         
      </div>

      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>our address</h3>
         <a href="#">We'll keep you updated!</a>
      </div>

      <div class="box">
         <img src="images/phone-icon.png" alt="">
         <h3>our number</h3>
         <a href="tel:(+63) 915-288-6906">(+63) 915-288-6906</a>
      </div>

   </section>

   <div class="credit">&copy; copyright @ <?= date('Y'); ?> by <span>BSIT-3B Group 1</span> | San Beda College Alabang</div>

</footer>

<div class="loader">
   <img src="images/loader1.gif" alt="">
</div>

<style>
.loader{
   position: fixed;
   top:0; left:0; right:0; bottom: 0;
   z-index: 1000000;
   background-color: var(--white);
   display: flex;
   align-items: center;
   justify-content: center;
   scale: 5;
}

.loader img{
   height: 100px;
   width: 100px;
}

.footer .grid {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr));
   gap: 1.5rem;
   justify-items: stretch; /* Ensure all boxes take up the full width */
   align-items: flex-start; /* Vertical alignment remains at the top */
}


</style>