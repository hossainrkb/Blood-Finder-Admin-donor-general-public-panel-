<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0;background: cadetblue">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="background:darkcyan" href="#">Blood Finder</a> 
    </div>
    <div class="row" style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
       <table>
           <tr>
               <td style="padding-right: 5px">
                   
<b>Admin : <a href="#" class="btn btn-sm btn-info" style=""><b>{{  Auth :: guard ('admin')->check() ? Auth :: guard ('admin')->user()->a_name : '' }}</b></a> 
       </td>
        <td>
               <form id="" class=""  action="{{ route('admin.logout') }}" method="POST" >
            @csrf
            <input type="submit" class="btn btn-info btn-sm square-btn-adjust" style="font-weight: bold" name="" value="Logout">
        </form>
           
       </td>
               
           </tr>
       </table>
    </div>
   
</nav> 