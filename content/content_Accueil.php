       <header>
        <div class="container py-6 py-md-7  text-white z-index-20">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center text-sm-left">
                <p class="subtitle letter-spacing-4 mb-0 text-secondary">Trouve des logements qui font rever à un prix bien raisonnable</p>
              <h1 class="display-4 font-weight-bold text-shadow" style="color: blue">ça vaut le cout de chercher! </h1>
            </div>
            <div class="search-bar mt-5 p-3 p-lg-1 p-1 pl-lg-4">
                <form action="index.php" method="GET">
                <div class="row">
                  <div class="col-lg-3 d-flex align-items-center form-group">
                      <input class="form-control border-0 shadow-0" type="number" name="prix" placeholder="prix ">
                  </div>
                  <div class="col-lg-3 d-flex align-items-center form-group">
                    <div class="input-label-absolute input-label-absolute-right w-100 ui-widget">
                      <label class="label-absolute" for="localisation"></label>
                      <input class="form-control border-0 shadow-0" type="text" name="localisation" placeholder="Ville" id="localisation">

                    </div>
                  </div>
                  <div class="col-lg-3 d-flex align-items-center form-group no-divider">
                      <select class="selectpicker" title="Categories" data-style="btn-form-control" name="categorie">
                      <option value="Appartemment">Appartement</option>
                      <option value="Hotel">Hotel </option>
                      <option value="Maison">Maison</option>
                      <option value="Bureau">Bureau</option>
                      <option value="Boutique">Boutique</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <button class="btn btn-primary btn-block rounded-xl h-100" type="submit">c'est parti !</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
       </header>
   
            <?php
            
                Annonce::search($dbh );
            
            
         