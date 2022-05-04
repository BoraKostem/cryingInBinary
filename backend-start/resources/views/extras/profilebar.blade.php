<style>
    .sidebar-grey {
      background-color: #ebebeb;
    }

    #sidebar {
    left: 0;
    z-index: 100;
    background: #ebebeb;
    color: #fff;
    transition: all 0.3s;
    }

.btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
    background-color: #003366 !important;
    color: #fff;
}


/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 0 0;
  background: #ebebeb;
}

.profile-userpic img {
  float: none;
  width: 75%;
  height: 75%;
  margin-left: auto;
  margin-right: auto;
  display: block;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
  margin-bottom: 20px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}

.information-texts {
    color: black;
    margin-left: 20px;
}
    

</style>


<div class="row">
            <div class="profile-sidebar" id="sidebar"  style="border:2px solid #aeaeae;">
                <div class="profile-userpic">
                  <!--//Control for profile picture path -->
                  @if(!isset($userInfo['pp_path']))
                    <img src="{{URL::asset('/image/Profile-720.png')}}" class="img-responsive" alt="">
                  @else
                    <img src="{{URL::asset('')}}" class="img-responsive" alt="">
                  @endif      
				        </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                      @if($userInfo['job'] != 'administrator')
                        {{$userInfo['name']}}
                      @else
                        <strong>ADMIN</strong>
                      @endif

                    </div>
                    <div class="profile-usertitle-job">
                      {{$userInfo['bilkentID']}}
                    </div>
				        </div>

                @if($userInfo['job'] != 'administrator')
                  <div class="profile-userbuttons">
                      <button type="button" class="btn btn-custom btn-sm">Profile</button>
                  </div>
                @endif

                @if($userInfo['job'] != 'administrator')
                    <div class="information-texts">
                      @if(isset($userInfo['hescode']))
                      COVID-19 Status: <p class="text-success" style="display:inline">Healthy!</p>
                      @else
                      COVID-19 Status: <p class="text-secondary" style="display:inline">Not Found</p> 
                      @endif
                    </div>
                    @if($userInfo['job'] == 'bilkenter')
                        <div class="information-texts mt-2">
                          @if(isset($userInfo['birthday']))
                          Age: --Add Age Later--
                          @else
                          Age: -
                          @endif
                        </div>

                        <div class="information-texts mt-2">
                          @if(isset($userInfo['height']))
                          Height: {{$userInfo['height']}}
                          @else
                          Height: -
                          @endif
                        </div>

                        <div class="information-texts mt-2 mb-4">
                          @if(isset($userInfo['weight']))
                          Weight: {{$userInfo['weight']}}
                          @else
                          Weight: -
                          @endif
                        </div>
                    @endif
                @endif
            </div>
</div>
