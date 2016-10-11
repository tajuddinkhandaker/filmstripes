@extends('layouts.app')

@section('title', 'New Movie')

@section('error-stripe')

@section('content')
<div class="container spark-screen filmstripes-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <span class="glyphicon glyphicon-film"></span>
                    <!-- Add clearfix for only the required viewport -->
                    <div class="clearfix visible-xs"></div>New Movie? Yay!
                </div>

                <div class="panel-body">

                    <form is="iron-form" method="post" action="{{ route('movies::register') }}" id="movie_register_form">

                        {{ csrf_field() }}

                        <paper-input-container id="title_container" required char-counter autocorrect>
                          <label>Title</label>
                          <input is="iron-input" name="title" id="title" maxlength="20">
                          <paper-input-char-counter></paper-input-char-counter>
                          <paper-icon-button suffix onclick="clearInput('title')" icon="clear" alt="clear" title="clear"></paper-icon-button>
                        </paper-input-container>

                        <div class="mdl-grid">
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container id="release_year_container" required auto-validate>
                                <label>Release year</label>
                                <input is="iron-input" name="release_year" id="release_year" pattern="[0-9]{4}">
                                <paper-input-error>Wrong year! Please check again.</paper-input-error>
                            </paper-input-container>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <crystal-dropdown-menu  id="genre" name="genre" label="Genre" selected="1"
                                                    dataset="{{ $genres }}">
                            </crystal-dropdown-menu>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container auto-validate>
                              <div suffix>mins</div>
                              <label>Length</label>
                              <input is="iron-input" name="length" id="length" pattern="[0-9]*">
                              <paper-input-error>Only numbers!<br/>e.g. 120 mins</paper-input-error>
                            </paper-input-container>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container name="resolution" auto-validate>
                              <div suffix>p</div>
                              <label>Resolution</label>
                              <input is="iron-input" pattern="[0-9]*">
                              <paper-input-error>Only numbers!<br/>e.g. 1080p, 720p</paper-input-error>
                            </paper-input-container>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <crystal-dropdown-menu  id="language" name="language" label="Language" selected="1"
                                                    dataset="{{ $languages }}">
                            </crystal-dropdown-menu>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container name="size" auto-validate>
                              <div suffix>MB</div>
                              <label>Size</label>
                              <input is="iron-input" pattern="[0-9]*">
                              <paper-input-error>Only numbers!<br/>e.g. 1024 MB</paper-input-error>
                            </paper-input-container>
                          </div>
                        </div>
                        <div class="mdl-grid">
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="watched" value="checked">Watched</paper-checkbox></br></br>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="burned" value="checked">Burned</paper-checkbox></br></br>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="in_boxset" value="checked">In Boxset</paper-checkbox></br></br>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="downloaded" value="checked">Downloaded</paper-checkbox></br></br>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="adult" value="checked">Adult</paper-checkbox></br></br>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-checkbox name="searchable" value="checked">Searchable</paper-checkbox></br></br>
                          </div>
                        </div>
                        <div class="mdl-grid">
                          <div class="mdl-cell mdl-cell--5-col">
                            <paper-dropdown-menu name="boxset" class="{{ (isset($inBoxset) && $inBoxset) ? 'hidden' : '' }}" label="Boxset">
                              <paper-listbox class="dropdown-content">
                                <paper-item>Iron Man</paper-item>
                                <paper-item>Avengers</paper-item>
                                <paper-item>Captain Ameraica</paper-item>
                                <paper-item>Batman</paper-item>
                                <paper-item>Spider Man</paper-item>
                              </paper-listbox>
                            </paper-dropdown-menu>
                            <paper-icon-button suffix onclick="openBoxsetForm('boxset_form_modal')" icon="add" alt="add"></paper-icon-button>
                          </div>
                          <div class="mdl-cell mdl-cell--5-col">
                            <paper-dropdown-menu name="dvd" label="DVD">
                              <paper-listbox class="dropdown-content">
                                <paper-item>Action Movies 5</paper-item>
                                <paper-item>Horror Movies 4</paper-item>
                              </paper-listbox>
                            </paper-dropdown-menu>
                            <paper-icon-button suffix onclick="openDvdForm('dvd_form_modal')" icon="add" alt="add"></paper-icon-button>
                          </div>
                        </div>

                        <paper-input  name="poster_url" label="Poster URL"
                                      placeholder="http://, https://" type="url" 
                                      error-message="Enter valid source URL" value="" auto-validate></paper-input>
                        <paper-input  name="imdb_url" label="IMDB URL"
                                      placeholder="http://, https://" type="url" 
                                      error-message="Enter valid source URL" value="" auto-validate></paper-input>

                        <paper-textarea name="comments" label="Comments" char-counter maxlength="500"></paper-textarea>

                        <paper-button id="btnSubmit" raised onclick="_submit(event)">
                          <paper-spinner id="spinner" hidden></paper-spinner>Submit</paper-button>
                        <paper-button raised onclick="_reset(event)">Reset</paper-button>
                        <div class="output"></div>
                    </form>
                    <script>
                        function clearInput(id) {
                            document.getElementById(id).value = null;
                        }

                        function _submit(event) {
                            // spinner.active = true;
                            // spinner.hidden = false;
                            Polymer.dom(event).localTarget.parentElement.submit();
                        }
                        function _reset(event) {
                            var form = Polymer.dom(event).localTarget.parentElement;
                            form.reset();
                            // form.querySelector('.output').innerHTML = '';
                            // spinner.active = false;
                            // spinner.hidden = true;
                        }
                        // movie_register_form.addEventListener('iron-form-presubmit', function(event) {
                        //     // this.request.params['sidekick'] = 'Robin';
                        // });
                        movie_register_form.addEventListener('iron-form-submit', function(event) {
                            // spinner.active = false;
                            // spinner.hidden = true;
                            this.querySelector('.output').innerHTML = JSON.stringify(event.detail);
                            movie_register_form.reset();
                        });
                        movie_register_form.addEventListener('iron-form-error', function(event) {
                            // $('.output').attr('display' ,'block');
                            // document.querySelector('div.output').innerHTML = '<div class="alert alert-error">' + JSON.stringify(event.detail) + '</div>';
                            // console.log(event.detail);
                            var errorStripe = document.querySelector('div#error-stripe');
                            errorStripe.setAttribute("errorType", "error");
                            errorStripe.setAttribute("errorText", "Your movie is not added due to some server error! Please try again.");
                        });
                        movie_register_form.addEventListener('iron-form-response', function(event) {
                            // console.log(event.detail);
                            var errorStripe = document.querySelector('div#error-stripe');
                            errorStripe.setAttribute("errorType", "success");
                            errorStripe.setAttribute("errorText", "You have added a new movie successfully!");
                        });
                    </script>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
