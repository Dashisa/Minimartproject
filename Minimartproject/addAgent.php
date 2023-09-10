<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add Agent</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">

      <select name="category" class="box" id="category"  required>
       <option value="Grocery">Grocery</option>
       <option value="Stationary">Stationary</option>
       <option value="Homeware">Homeware</option>
      
      </select>
      <select name="SubCategory" class="box" id="SubCcategory"  required>
       <option value="Grocery">Grocery</option>
       <option value="Snacks">Snacks</option>
       <option value="Vegetables">Vegetables</option>
       <option value="Fruits">Fruits</option>
       <option value="Beverages">Beverages</option>
       
      </select>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>