@extends('layouts.app')

@section('title', 'New Movie')

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

                    <form is="iron-form" method="post" action="{{ route('movies::register') }}" id="presubmit">

                        {{ csrf_field() }}

                        <paper-input-container name="title" id="title_container" required char-counter autocorrect>
                          <label>Title</label>
                          <input is="iron-input" id="title" maxlength="20">
                          <paper-input-char-counter></paper-input-char-counter>
                          <paper-icon-button suffix onclick="clearInput('title')" icon="clear" alt="clear" title="clear"></paper-icon-button>
                        </paper-input-container>

                        <div class="mdl-grid">
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container name="release_year" required auto-validate>
                                <label>Release year</label>
                                <input is="iron-input" pattern="[0-9]{4}">
                                <paper-input-error>Wrong year! Please check again.</paper-input-error>
                            </paper-input-container>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-dropdown-menu name="genre" label="Genre">
                              <paper-listbox class="dropdown-content" selected="1">
                                <paper-item>Horror</paper-item>
                                <paper-item>Adventure</paper-item>
                                <paper-item>Romantic</paper-item>
                                <paper-item>Sci-Fi</paper-item>
                              </paper-listbox>
                            </paper-dropdown-menu>
                          </div>
                          <div class="mdl-cell mdl-cell--2-col">
                            <paper-input-container name="length" auto-validate>
                              <div suffix>mins</div>
                              <label>Length</label>
                              <input is="iron-input" pattern="[0-9]*">
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
                            <paper-dropdown-menu name="language" label="Language">
                              <paper-listbox class="dropdown-content">
                                <paper-item>English</paper-item>
                                <paper-item>Bengali</paper-item>
                                <paper-item>Hindi</paper-item>
                                <paper-item>Chinese</paper-item>
                                <paper-item>Korean</paper-item>
                              </paper-listbox>
                            </paper-dropdown-menu>
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
                            spinner.active = true;
                            spinner.hidden = false;
                            Polymer.dom(event).localTarget.parentElement.submit();
                        }
                        function _reset(event) {
                            var form = Polymer.dom(event).localTarget.parentElement;
                            form.reset();
                            form.querySelector('.output').innerHTML = '';
                        }
                        presubmit.addEventListener('iron-form-presubmit', function(event) {
                            this.request.params['sidekick'] = 'Robin';
                        });
                        presubmit.addEventListener('iron-form-submit', function(event) {
                            spinner.active = false;
                            spinner.hidden = true;
                            this.querySelector('.output').innerHTML = JSON.stringify(event.detail);
                        });
                    </script>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
