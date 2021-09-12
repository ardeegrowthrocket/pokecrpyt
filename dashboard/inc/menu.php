<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



<li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=changepass" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=editprofile" class="nav-link">
                  <i class="fas fa-address-card nav-icon"></i>
                  <p>Edit Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=withdrawhistory" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Withdrawal History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=shop" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Item Shop</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=useitems" class="nav-link">
                  <i class="fas fa-level-up-alt nav-icon"></i>
                  <p>Upgrade Pokemon</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="index.php?pages=catch" class="nav-link">
                  <i class="fas fa-pastafarianism nav-icon"></i>
                  <p>Catch a Pokemon</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=pokemon" class="nav-link">
                  <i class="fas fa-pastafarianism nav-icon"></i>
                  <p>My Pokemon</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=pokebattle" class="nav-link">
                  <i class="fas fa-chess-knight nav-icon"></i>
                  <p>My Battles</p>
                </a>
              </li>



           </ul>
</li>

<!--
              <li class="nav-item">
                <a href="index.php?pages=bonushistory" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Bonus History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=paymenthistory" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Payment History</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="index.php?pages=exchangehistory" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Exchange History</p>
                </a>
              </li>




          <li class="nav-item">
            <a href="index.php?pages=subscription" class="nav-link">
              <i class="nav-icon fas fa-satellite-dish"></i>
              <p>
                Table Matrix Subscription
              </p>
            </a>
          </li>
		  

          <li class="nav-item">
            <a href="index.php?pages=exchangerequest" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Request Exchanges
              </p>
            </a>
          </li>		  

          <li class="nav-item">
            <a href="index.php?pages=genes" class="nav-link">
              <i class="nav-icon fas fa-dna"></i>
              <p>
                Genealogy
              </p>
            </a>
          </li>		  
-->



          <li class="nav-item">
            <a href="index.php?pages=withdrawrequest" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Request Withdraw
              </p>
            </a>
          </li>











<?php if ($_SESSION['role']==1) { ?>

          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Administration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">



              <li class="nav-item">
                <a href="index.php?pages=users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=items" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Items</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=withdraw" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=exchange" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exchanges</p>
                </a>
              </li>



              <li class="nav-item">
                <a href="index.php?pages=payments" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=bonuses" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bonuses</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=cms" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS Pages</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=system" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Configuration</p>
                </a>
              </li>
              
           </ul></li>
<?php } ?>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
         </ul>
      </nav>