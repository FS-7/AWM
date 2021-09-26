<?

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 
  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
 
  $headers = [
    'Accept: application/vnd.github.v3+json, application/json',
    'User-Agent: https://localhost/'
  ];
 
  if(isset($_SESSION['access_token']))
    $headers[] = 'Authorization: Bearer '.$_SESSION['access_token'];
 
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
  $response = curl_exec($ch);
  return json_decode($response, true);
}

$githubClientID = '';
$githubClientSecret = '';
 
// This is the URL we'll send the user to first
// to get their authorization
$authorizeURL = 'https://github.com/login/oauth/authorize';
 
// This is the endpoint we'll request an access token from
$tokenURL = 'https://github.com/login/oauth/access_token';
 
// This is the GitHub base URL for API requests
$apiURLBase = 'https://api.github.com/';
 
// The URL for this script, used as the redirect URL
$baseURL = 'https://' . $_SERVER['SERVER_NAME']
    . $_SERVER['PHP_SELF'];
 
// Start a session so we have a place to
// store things between redirects

session_start();

if(!isset($_GET['action'])) {
  if(!empty($_SESSION['access_token'])) {
    echo 'lol';
    echo '<h3>Logged In</h3>';
    echo '<p><a href="?action=repos">View Repos</a></p>';
    echo '<p><a href="?action=logout">Log Out</a></p>';
  } else {
    echo '<h3>Not logged in</h3>';
    echo '<p><a href="?action=login">Log In</a></p>';
  }
  die();
}
/*/
if(isset($_GET['action']) && $_GET['action'] == 'login') {
    unset($_SESSION['access_token']);
   
    // Generate a random hash and store in the session
    $_SESSION['state'] = bin2hex(random_bytes(16));
   
    $params = array(
      'response_type' => 'code',
      'client_id' => $githubClientID,
      'redirect_uri' => $baseURL,
      'scope' => 'user public_repo',
      'state' => $_SESSION['state']
    );
   
    // Redirect the user to GitHub's authorization page
    header('Location: '.$authorizeURL.'?'.http_build_query($params));
    die();
  }*/
?>