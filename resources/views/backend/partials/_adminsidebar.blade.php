 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION </li>
        <li><a href="{{ url('backoffice/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       
        @if(User::isSuperAdmin())
          <li class="treeview {{ Request::is('backoffice/user/*')?'active':'' }}">
            <a href="#">
              <i class="fa fa-user"></i> <span>User Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li {{ Request::is('backoffice/user/users')?"class=active":'' }}{{ Request::is('backoffice/user/*')?"class=active":'' }}><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Users</a></li>
              <li {{ Request::is('backoffice/user/register')?"class=active":'' }}><a href="{{ url('backoffice/user/register') }}"><i class="fa fa-circle-o"></i>Create User</a></li>
            </ul>
          </li>


         <li class="treeview {{ Request::is('backoffice/catalog/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-share"></i> <span>Catalog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{ Request::is('backoffice/catalog/categories/*')?"class=active":'' }}{{ Request::is('backoffice/catalog/categories')?"class=active":'' }}><a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i>Categories</a></li>
            <li {{Request::is('backoffice/catalog/products/*')? "class=active":''}}{{Request::is('backoffice/catalog/products')? "class=active":''}}><a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i>Products</a></li>
            <li {{ Request::is('backoffice/catalog/brands/*')?"class=active":'' }}{{ Request::is('backoffice/catalog/brands')?"class=active":'' }}><a href="{{route('brands.index')}}"><i class="fa fa-circle-o"></i>Brands</a></li>
          </ul>
        </li>
       

        <li class="treeview {{ Request::is('backoffice/module/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-share"></i> <span>Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li {{ Request::is('backoffice/module/company/*')?"class=active":'' }}{{ Request::is('backoffice/module/company')?"class=active":'' }}><a href="{{route('company.index')}}"><i class="fa fa-circle-o"></i>Company</a></li>
            <li {{ Request::is('backoffice/module/departments/*')?"class=active":'' }}{{ Request::is('backoffice/module/departments')?"class=active":'' }}><a href="{{route('departments.index')}}"><i class="fa fa-circle-o"></i>Departments</a></li>
            <li {{ Request::is('backoffice/module/jobs/*')?"class=active":'' }}{{ Request::is('backoffice/module/jobs')?"class=active":'' }}><a href="{{route('jobs.index')}}"><i class="fa fa-circle-o"></i>Jobs</a></li>
            <li {{ Request::is('backoffice/module/testimonials/*')?"class=active":'' }}{{ Request::is('backoffice/module/testimonials')?"class=active":'' }}><a href="{{route('testimonials.index')}}"><i class="fa fa-circle-o"></i>Testimonials</a></li>
            <li {{ Request::is('backoffice/module/members/*')?"class=active":'' }}{{ Request::is('backoffice/module/members')?"class=active":'' }}><a href="{{route('members.index')}}"><i class="fa fa-circle-o"></i>Team Members</a></li>
            <li {{ Request::is('backoffice/module/services/*')?"class=active":'' }}{{ Request::is('backoffice/module/services')?"class=active":'' }}><a href="{{route('services.index')}}"><i class="fa fa-circle-o"></i>Services</a></li>
            <li {{Request::is('backoffice/module/news/*')?"class=active":'' }}{{ Request::is('backoffice/module/news')?"class=active":''}}><a href="{{route('news.index')}}"><i class="fa fa-circle-o"></i>News</a></li>
            <li {{Request::is('backoffice/module/locations/*')?"class=active":'' }}{{ Request::is('backoffice/module/locations')?"class=active":''}}><a href="{{route('locations.index')}}"><i class="fa fa-circle-o"></i>Locations</a></li>
            <li {{Request::is('backoffice/module/comments/*')?"class=active":'' }}{{ Request::is('backoffice/module/comments')?"class=active":''}}><a href="{{route('comments.index')}}"><i class="fa fa-circle-o"></i>Comments</a></li>
            <li {{Request::is('backoffice/module/ratings/*')?"class=active":'' }}{{ Request::is('backoffice/module/ratings')?"class=active":''}}><a href="{{route('ratings.index')}}"><i class="fa fa-circle-o"></i>Ratings</a></li>
            <li {{Request::is('backoffice/module/informations/*')?"class=active":'' }}{{ Request::is('backoffice/module/informations')?"class=active":''}}><a href="{{route('informations.index')}}"><i class="fa fa-circle-o"></i>Informations</a></li>
             <li {{Request::is('backoffice/module/subscribers/*')?"class=active":'' }}{{ Request::is('backoffice/module/subscribers')?"class=active":''}}><a href="{{route('subscribers.index')}}"><i class="fa fa-circle-o"></i>Subscribers</a></li>
          </ul>
        </li>

          <li id="pages" class="treeview {{ Request::is('backoffice/pages/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
               <li {{ Request::is('backoffice/pages')?"class=active":'' }}><a href="{{route('pages.index')}}"><i class="fa fa-circle-o"></i>Pages</a></li>
               <li {{ Request::is('backoffice/pages/blocks/*')?"class=active":'' }} id="hp">
                  <a href="#"><i class="fa fa-circle-o"></i>Blocks
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                   <ul class="treeview-menu">
                <li {{ Request::is('backoffice/pages/blocks/header')?"class=active":'' }}><a href="{{route('blocks.show','header')}}"><i class="fa fa-circle-o"></i>Header</a></li>
                 <li {{ Request::is('backoffice/pages/blocks/social')?"class=active":'' }}><a href="{{route('blocks.show','social')}}"><i class="fa fa-circle-o"></i>Social</a></li>
                 <li  {{ Request::is('backoffice/pages/blocks/homepage-categories')?"class=active":'' }} ><a href="{{ route('blocks.show', 'homepage-categories') }}" ><i class="fa fa-circle-o"></i>Homepage categories</a></li>
                  
                  <li  {{ Request::is('backoffice/pages/blocks/homepage-stats')?"class=active":'' }} ><a href="{{ route('blocks.show', 'homepage-stats') }}" ><i class="fa fa-circle-o"></i>Homepage Stats</a></li>
                   <li  {{ Request::is('backoffice/pages/blocks/footer')?"class=active":'' }} ><a href="{{ route('blocks.show', 'footer') }}" ><i class="fa fa-circle-o"></i>Footer</a></li>
                   <li  {{ Request::is('backoffice/pages/blocks/about-yellowbox')?"class=active":'' }} ><a href="{{ route('blocks.show', 'about-yellowbox') }}" ><i class="fa fa-circle-o"></i>About-Yellow Box</a></li>
                  <li  {{ Request::is('backoffice/pages/blocks/about-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'about-quickfact') }}" ><i class="fa fa-circle-o"></i>About-Quick Fact</a></li>
                  <li  {{ Request::is('backoffice/pages/blocks/about-stats')?"class=active":'' }} ><a href="{{ route('blocks.show', 'about-stats') }}" ><i class="fa fa-circle-o"></i>About-Stats</a></li>

                  <li  {{ Request::is('backoffice/pages/blocks/industry-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'industry-quickfact') }}" ><i class="fa fa-circle-o"></i>Industry-Quick Fact</a></li>
                  <li  {{ Request::is('backoffice/pages/blocks/industry-yellowbox')?"class=active":'' }} ><a href="{{ route('blocks.show', 'industry-yellowbox') }}" ><i class="fa fa-circle-o"></i>Industry-Yellow Box</a></li>
                  <li  {{ Request::is('backoffice/pages/blocks/industry-stats')?"class=active":'' }} ><a href="{{ route('blocks.show', 'industry-stats') }}" ><i class="fa fa-circle-o"></i>Industry-Stats</a></li>

                  <li  {{ Request::is('backoffice/pages/blocks/mission-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'mission-quickfact') }}" ><i class="fa fa-circle-o"></i>Mission-Quick Fact</a></li>

                   <li  {{ Request::is('backoffice/pages/blocks/approach-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'approach-quickfact') }}" ><i class="fa fa-circle-o"></i>Approach-Quick Fact</a></li>
                    <li  {{ Request::is('backoffice/pages/blocks/approach-yellowbox')?"class=active":'' }} ><a href="{{ route('blocks.show', 'approach-yellowbox') }}" ><i class="fa fa-circle-o"></i>Approach-Yellow Box</a></li>
                  
                  <li  {{ Request::is('backoffice/pages/blocks/team-leaders')?"class=active":'' }} ><a href="{{ route('blocks.show', 'team-leaders') }}" ><i class="fa fa-circle-o"></i>Team-Leaders</a></li>
                 <li  {{ Request::is('backoffice/pages/blocks/team-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'team-quickfact') }}" ><i class="fa fa-circle-o"></i>Team-Quick Fact</a></li>

                 <li  {{ Request::is('backoffice/pages/blocks/career-work')?"class=active":'' }} ><a href="{{ route('blocks.show', 'career-work') }}" ><i class="fa fa-circle-o"></i>Career-Work</a></li>

                 <li  {{ Request::is('backoffice/pages/blocks/blog-quickfact')?"class=active":'' }} ><a href="{{ route('blocks.show', 'blog-quickfact') }}" ><i class="fa fa-circle-o"></i>Blog-Quick Fact</a></li>



                 </ul>
                 </li>
                <li id="hp">
                  <a href="#"><i class="fa fa-circle-o"></i>Home Page
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li  {{ $activeLink=='home-slider'?'class=active':''}} id="test"><a href="{{ route('pages.show', ['id' => '14']) }}" ><i class="fa fa-circle-o"></i> Main Slider</a></li>

                    <li {{ $activeLink=='home-comp'?'class=active':''}}><a href="{{route('pages.show', ['id' => '10']) }}"><i class="fa fa-circle-o"></i> Company Section</a></li>

                    <li {{ $activeLink=='home-rating'?'class=active':''}}><a href="{{ route('pages.show',['11']) }}"><i class="fa fa-circle-o"></i> Service Rating</a></li>
                    <li {{ $activeLink=='home-ceo'?'class=active':''}}><a href="{{ route('pages.show',['12']) }}"><i class="fa fa-circle-o"></i> CEO Message</a></li>
                     <li  {{ $activeLink=='home-publications'?'class=active':''}}><a href="{{ route('pages.show',['13']) }}"><i class="fa fa-circle-o"></i>Publications</a></li>
                  </ul>
                </li>
              </ul>


              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>About Us
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='about-top-image'?'class=active':''}}><a href="{{ route('pages.show','20') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='about-company'?'class=active':''}}><a href="{{route('pages.show','21') }}"><i class="fa fa-circle-o"></i> Company</a></li>

                    <li {{ $activeLink=='about-culture'?'class=active':''}}><a href="{{route('pages.show','22') }}"><i class="fa fa-circle-o"></i> Culture</a></li>


                    <li {{ $activeLink=='about-accordian'?'class=active':''}}><a href="{{ route('pages.show','23') }}"><i class="fa fa-circle-o"></i> Accordian</a></li>
                     
                  </ul>
                </li>
              </ul>
              
              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Industry
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='industry-top-image'?'class=active':''}}><a href="{{ route('pages.show','30') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='industry-innovation'?'class=active':''}}><a href="{{route('pages.show','31') }}"><i class="fa fa-circle-o"></i> Innovation</a></li>

                    <li {{ $activeLink=='industry-culture'?'class=active':''}}><a href="{{route('pages.show','32') }}"><i class="fa fa-circle-o"></i> Culture</a></li>


                    <li {{ $activeLink=='about-accordian'?'class=active':''}}><a href="{{ route('pages.show','33') }}"><i class="fa fa-circle-o"></i> Accordian</a></li>
                     
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Mission/Vision
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='mission-top-image'?'class=active':''}}><a href="{{ route('pages.show','40') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='mission-vision'?'class=active':''}}><a href="{{route('pages.show','41') }}"><i class="fa fa-circle-o"></i> Mission/Vision</a></li>

                    <li {{ $activeLink=='vision-points'?'class=active':''}}><a href="{{route('pages.show','42') }}"><i class="fa fa-circle-o"></i> Vision Points</a></li>


                    <li {{ $activeLink=='mission-points'?'class=active':''}}><a href="{{ route('pages.show','43') }}"><i class="fa fa-circle-o"></i> Mission Points</a></li>
                     
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Approach
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='approach-top-image'?'class=active':''}}><a href="{{ route('pages.show','50') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='approach-approach'?'class=active':''}}><a href="{{route('pages.show','51') }}"><i class="fa fa-circle-o"></i> Approach</a></li>

                    <li {{ $activeLink=='approach-emp-benefits'?'class=active':''}}><a href="{{route('pages.show','52') }}"><i class="fa fa-circle-o"></i> Employee Benefits</a></li>


                    <li {{ $activeLink=='approach-quality-points'?'class=active':''}}><a href="{{ route('pages.show','53') }}"><i class="fa fa-circle-o"></i> Quality Points</a></li>
                     
                     <li {{ $activeLink=='approach-advantages-points'?'class=active':''}}><a href="{{ route('pages.show','54') }}"><i class="fa fa-circle-o"></i> Advantages Points</a></li>
                     
                  </ul>
                </li>
              </ul>

               <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Our Team
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='team-top-image'?'class=active':''}}><a href="{{ route('pages.show','60') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='team-team'?'class=active':''}}><a href="{{route('pages.show','61') }}"><i class="fa fa-circle-o"></i> Team</a></li>

                     
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Careers
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">

                  <li {{ $activeLink=='career-top-image'?'class=active':''}}><a href="{{ route('pages.show','70') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>

                    <li {{ $activeLink=='career-culture'?'class=active':''}}><a href="{{route('pages.show','71') }}"><i class="fa fa-circle-o"></i> Culture</a></li>

                     
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Contact
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='contact-top-image'?'class=active':''}}><a href="{{ route('pages.show','80') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Blog
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='blog-top-image'?'class=active':''}}><a href="{{ route('pages.show','90') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>News
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='news-top-image'?'class=active':''}}><a href="{{ route('pages.show','100') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Categories
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='categories-top-image'?'class=active':''}}><a href="{{ route('pages.show','110') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Product List
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='productlist-top-image'?'class=active':''}}><a href="{{ route('pages.show','120') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Product
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='product-top-image'?'class=active':''}}><a href="{{ route('pages.show','130') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Service
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='service-top-image'?'class=active':''}}><a href="{{ route('pages.show','140') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Register
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='register-top-image'?'class=active':''}}><a href="{{ route('pages.show','150') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  <li {{ $activeLink=='register-benefits'?'class=active':''}}><a href="{{ route('pages.show','151') }}"><i class="fa fa-circle-o"></i> Benefits</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="treeview-menu">
                <li >
                  <a href="#"><i class="fa fa-circle-o"></i>Post
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li {{ $activeLink=='post-top-image'?'class=active':''}}><a href="{{ route('pages.show','160') }}"><i class="fa fa-circle-o"></i> Top Image</a></li>
                  </ul>
                </li>
              </ul>


        </li>

 
         <li class="treeview {{ Request::is('backoffice/blog/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{ Request::is('backoffice/blog/posts/*')?"class=active":'' }}{{ Request::is('backoffice/blog/posts')?"class=active":'' }}><a href="{{ route('posts.index') }}"><i class="fa fa-circle-o"></i>Posts</a></li>
            <li {{ Request::is('backoffice/blog/blogcategory/*')?"class=active":'' }}{{ Request::is('backoffice/blog/blogcategory')?"class=active":'' }}><a href="{{ route('blogcategory.index') }}"><i class="fa fa-circle-o"></i>Blog Categories</a></li>
            <li {{ Request::is('backoffice/blog/tags/*')?"class=active":'' }}{{ Request::is('backoffice/blog/tags')?"class=active":'' }}><a href="{{ route('tags.index') }}"><i class="fa fa-circle-o"></i>Tags</a></li>
           
          </ul>
        </li>

        <li class="treeview {{ Request::is('backoffice/customers/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{ Request::is('backoffice/customers/customers/*')?"class=active":'' }}{{ Request::is('backoffice/customers/customers')?"class=active":'' }}><a href="{{ route('customers.index') }}"><i class="fa fa-circle-o"></i>Customers</a></li>
           
           
           
          </ul>
        </li>
@endif
        <li class="treeview {{ Request::is('backoffice/quotes/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Quote</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{ Request::is('backoffice/quotes/quote-requests/*')?"class=active":'' }}{{ Request::is('backoffice/quotes/quote-requests')?"class=active":'' }}><a href="{{ route('quote-requests.index') }}"><i class="fa fa-circle-o"></i>Quote Requests</a></li>
           
           
           
          </ul>
        </li>
        <li class="treeview {{ Request::is('backoffice/orders/*')?'active':'' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{ Request::is('backoffice/orders/*')?"class=active":'' }}{{ Request::is('backoffice/orders')?"class=active":'' }}><a href="{{ route('orders.index') }}"><i class="fa fa-circle-o"></i>Orders</a></li>
           
           
           
          </ul>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>