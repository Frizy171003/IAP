<?php

function get_CURL($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true);
  
}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCQ6-zk2XH_FIjgKOJkdupOA&key=AIzaSyCJ-IfVuW56v_SNXtjEGtugpkFrduK25Gc');




$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

//latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyCJ-IfVuW56v_SNXtjEGtugpkFrduK25Gc&channelId=UCQ6-zk2XH_FIjgKOJkdupOA&maxResults=1&order=date&part=snippet';

$result = get_CURL($urlLatestVideo);
$latestVideoID = $result['items'][0]['id']['videoId'];

// Instagram API
$instagramResult = get_CURL('https://graph.instagram.com/me?fields=username,profile_picture_url,followers_count&access_token=IGAAH7iwrQvq5BZAE9vbko1NTNLX2VYSGJaOEFUMjhDVmJwNGd5NTJjN2lYTWJNb3hPUTF1VTZANc2luU25pLTBFNjFIZAkVwOVNKMkJGelE1NmFnUHdhYVZAkUjJDUlJ3VDZAUWVJaVWgxNWhZANm9DcXM0akZAfd1Q2MzFpU2VnVkFVZAwZDZD');

$igUsername = $instagramResult['username'];
$igProfilePic = $instagramResult['profile_picture_url'];
$igFollowers = $instagramResult['followers_count'];

$mediaResult = get_CURL('https://graph.instagram.com/me/media?fields=id,caption,media_url,permalink,thumbnail_url,media_type,timestamp&access_token=IGAAH7iwrQvq5BZAE9vbko1NTNLX2VYSGJaOEFUMjhDVmJwNGd5NTJjN2lYTWJNb3hPUTF1VTZANc2luU25pLTBFNjFIZAkVwOVNKMkJGelE1NmFnUHdhYVZAkUjJDUlJ3VDZAUWVJaVWgxNWhZANm9DcXM0akZAfd1Q2MzFpU2VnVkFVZAwZDZD');

$igMedia = array_slice($mediaResult['data'], 0, 3); 



?>
    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="<?= base_url(); ?>assets/img/profil.jpg" class="rounded-circle img-thumbnail">
          <h1 class="display-4">M. Frizy Oktario</h1>
          <h3 class="lead">Ilustrator | Programmer | Animator</h3>
        </div>
      </div>
    </div>


    <!-- About Me -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About Me</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Saya adalah seorang individu yang memiliki semangat tinggi dalam bidang teknologi dan pengembangan digital. Dengan latar belakang pendidikan dan pengalaman di bidang ini, saya terus berusaha menciptakan solusi kreatif yang tidak hanya fungsional, tetapi juga memberikan dampak nyata bagi pengguna</p>
          </div>
          <div class="col-md-5">
            <p>Melalui website ini, saya ingin membagikan karya, pengalaman, serta perjalanan saya dalam dunia profesional. Saya percaya bahwa kolaborasi dan pembelajaran berkelanjutan adalah kunci untuk berkembang, dan saya selalu terbuka untuk kesempatan baru serta tantangan yang membangun</p>
          </div>
        </div>
      </div>
    </section>

    <!-- social Media -->
  <section>
    <div class="social bg-light" id="social">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Social Media</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                <img src="<?=$youtubeProfilePic;?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                <h5><?=$channelName;?></h5>
                <p><?=$subscriber;?> Subscribers</p>
                <div class="g-ytsubscribe" data-channelid="UCQ6-zk2XH_FIjgKOJkdupOA" data-layout="default" data-count="default">
                </div>
              </div>
            </div>
            <div class="row pt-3 mb-3">
              <div class="col">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$latestVideoID;?>?rel=0" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                  <img src="<?=$igProfilePic;?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                  <h5><?=$igUsername;?></h5>
                  <p><?=$igFollowers;?> Followers</p>
              </div>
            </div>
            <div class="row pt-3 mb-3">
              <div class="col">
                <?php foreach($igMedia as $media): ?>
                  <div class="ig-thumbnail" style="display:inline-block; margin-right:10px;">
                    <a href="<?=$media['permalink'];?>" target="_blank">
                    <img src="<?=$media['media_url'];?>" width="100">
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- My Project -->
  <div class="container mt-5 mb-5">
  <div class="row mb-4">
    <div class="col text-center">
      <h2>My Project</h2>
    </div>
  </div>

  <!-- Portfolio -->
      <section class="portfolio" id="portfolio">
          <div class="row">
            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/json.png" alt="Card image cap">
                <div class="card-body">
                  <h5>JSON</h5>
                  <p class="card-text">Latihan API menggunakan file JSON.</p>
                  <a href="<?= base_url(); ?>../json/latihan1.php" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div>

            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/fhut.png" alt="Card image cap">
                <div class="card-body">
                  <h5>FRIZY-HUT</h5>
                  <p class="card-text">Latihan API menggunakan file JSON untuk data pizza dengan web.</p>
                  <a href="<?= base_url(); ?>../freeze-hut/latihan2.html" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div>

            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/movie.png" alt="Card image cap">
                <div class="card-body">
                  <h5>FRIZY-MOVIE</h5>
                  <p class="card-text">Latihan API menggunakan OMDb API untuk data movie dengan web.</p>
                  <a href="<?= base_url(); ?>../frizy-movie/index.html" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div>   
          </div>

          <div class="row">
            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/portfolio.png" alt="Card image cap">
                <div class="card-body">
                  <h5>FRIZY-PORTFOLIO</h5>
                  <p class="card-text">Latihan API menggunakan API Youtube dan Instagram memakai cURL untuk data akun berbasis web.</p>
                  <a href="<?= base_url(); ?>../frizy-portfolio/index.php" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div> 
            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/server.png" alt="Card image cap">
                <div class="card-body">
                  <h5>FRIZY-REST-SERVER</h5>
                  <p class="card-text">Membuat Rest Server menggunakan CodeIgniter.
                  </p>
                  <a href="<?= base_url(); ?>../frizy-rest-server/" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div>

            <div class="col-md mb-4">
              <div class="card">
                <img class="card-img-top" src="<?= base_url(); ?>assets/img/client.png" alt="Card image cap">
                <div class="card-body">
                  <h5>FRIZY-REST-CLIENT</h5>
                  <p class="card-text">Membuat Rest Client menggunakan CodeIgniter</p>
                  <a href="<?= base_url(); ?>home" class="card-link see-detail"data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.imdbID +`" >See Project</a>
                </div>
              </div>
            </div>
          </div>
      </section>
  </div>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Padang</h3></li>
              <li class="list-group-item">My Office</li>
              <li class="list-group-item">Jl. Pemuda No. 17, Padang</li>
              <li class="list-group-item">West Sumatera, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2025.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://apis.google.com/js/platform.js"></script>

