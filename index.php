<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<style>
  header{
    background-color: #aec3e1;
  }
  footer{
    background-color: #aec3e1;
  }
  .hover-shadow {
  transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.hover-shadow:hover {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  transform: translateY(-4px);
}

.icon-wrapper {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  transition: all 0.2s ease-in-out;
}

.hover-shadow:hover .icon-wrapper {
  background-color: #aec3e1;
  border-radius: 50%;
  transform: scale(1.15);
  width: 50px;
  height: 50px;
}

form.card input:focus,
form.card textarea:focus {
  border-color: #86b7fe;
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

form.card textarea {
  resize: none;
}

</style>

<body class="bg-light">

<!-- ✅ Header -->
<header class=" shadow-sm sticky-top">
  <div class="container-fluid py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
      <img src="logo.png" alt="Office Logo" style="height: 50px;">
      <h1 class="h5 text-center text-md-start mb-0">
        አዲስ ከተማ ክፍለ ከተማ የወረዳ 4 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት
      </h1>
    </div>
    <div class="d-flex align-items-center gap-3">
      <div class="d-flex gap-2">
        <a href="https://facebook.com" target="_blank" class="text-dark"><i class="bi bi-facebook  text-primary fs-5"></i></a>
        <a href="https://twitter.com" target="_blank" class="text-dark"><i class="bi bi-twitter-x  text-primary fs-5"></i></a>
        <a href="https://linkedin.com" target="_blank" class="text-dark"><i class="bi bi-linkedin text-primary fs-5"></i></a>
      </div>
      <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
    </div>
  </div>
</header>

<!-- ✅ Main Content -->
 <section class="mb-5 py-5 hero-section text-dark" style="background-color: #aec3e1;">
 <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2 class="fw-bold">እንኳን ደኅና መጣችሁ!</h2>
        <p class="lead">በወረዳ 11 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት የተሰራ ሲስተም ላይ ነን።</p>
      </div>
      <div class="col-md-6 text-center">
        <img src="tigist.jpg" alt="Hero Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
      </div>
    </div>
  </div>
</section>
<main class="container py-5">
  

  <!-- Vision Section -->
  <section class="mb-5">
አዲስ ከተማ ክፍለ ከተማ የወረዳ 4 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት በአዲስ አበባ ክፍለ ከተማ ከሚገኙ 12 የወረዳ አስተዳደሮች ውስጥ አንዱ የወረዳ 4 አስተዳደር ሲሆን በዚህ ወረዳ ውስጥ 5 የተለያዩ ነባር ቀበሌዎች ማለትም 07/17፣ 07/26፣ 06/01፣ 06/08 እና 24/10 የተባሉ ነባር ቀበሌዎች ሲኖሩት በ9 ቀጠናዎች የተከፋፈለ ነው።
  </section>
  <section class="mb-5">
    <h2 class="mb-3">የጽ/ቤቱ ሁኔታ</h2>
  <p>ጽ/ቤታችን ማለትም የወረዳ 4 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት የተለያዩ ተግባራት የሚያከናውን እና የተለያዩ አገልግሎቶችን የሚሰጥ ሲሆን እነዚህም በወረዳችን እርከን ደረጃ ዋና ዋና የሚባሉት የሚከተሉት ናቸው፡፡</p>
 <ul>
  <li>የእድሳት ፈቅድ መስጠት (ለቤት እና ለአጥር)</li>
  <li>40% ማስፋፊያ መስጠት </li>
  <li>የአጥር ግንባታ ፈቃድ መስጠት </li>
  <li>የማፍረሻ ፈቃድ መስጠት</li>
  <li>ጊዜያዊ ግንባታ ፈቃድ መስጠት</li>
  <li>ለተፈቀዱ ፈቃዶች ክትትልና ቁጥጥር ማድረግ</li>
  <li>ህገ ወጥ የውጭ ማስታወቂያ ላይ እርምጃ  መውሰድ እና ህጋዊ እንድሆኑ ማድረግ</li>  
  <li>የግንባታ ተረፈ ምርት ማስነሳት እና የግንባታ ግብዓት ምርት በአግባቡ እንዲያስቀምጡ ማድረግ </li>
  <li>ውብት በሚሰጥ መልኩ ቀለም ማስቀባት ተግባር ማከናወን (እስታንዳርዳይዜሽን የማስጠበቅ ስራ መስራት)</li>
  <li>ህግ ወጥ ግንባታ መከላከል ተግባራት ማከናወን</li>
 </ul>
  </section>

  <section class="mb-5">
    <h2 class="mb-3">የተቋሙ ራእይ (Vision)</h2>
    <p class="lead">
      በ 2025 በከተማችን የኮንስትራክሽን ኢንዱስትሪ መሰረተ ልማት ቅንጅት እና የውጪ ማስታወቂያ ስራዎችን ጥራትና ደህንነት በማስጠበቅ እና የሚገነቡ ግንባታዎች የከተማውን መዋቅራዊ ፕላን የጠበቁ በማድረግ ከተማችንን ለነዋሪዎች ምቹ እና በግንባታው ዘርፍ ከአፍሪካ ካሉት ምርጥ 10 ከተሞች አንደኛዋ ሆና ማየት።
    </p>
  </section>

  <!-- Mission Section -->
  <section class="mb-5">
    <h2 class="mb-3">የተቋሙ ተልእኮ (Mission)</h2>
    <p class="lead">
      የህብረተሰቡን እና የባለድርሻ አካላትን ፍላጎት መሰረት ያደረገ የመሰረተ ልማት ቅንጅትና የግንባታ ፍቃድና ቁጥጥር እንዲሁም የውጪ ማስታወቂያ አገልግሎት በመስጠት የሚከናወኑ ግንባታዎች ፕላንን የተከተሉ እና የተቀናጁ እንዲሁም ሥርዓቱን የተከተሉ በማድረግ አዲስ አበባ ከተማን ዘመናዊ እና ተወዳዳሪ ማድረግ። በአልሚዎች እና በነዋሪዎች የሚገነቡ ፕላን የተከተሉ በኮንስትራክሽን ኢንዱስትሪው የስራ ተቋራጮችን አማካሪዎችን እና የጥቃቅን እና አነስተኛ ተቋማትን ፈቃድ አሰጣጥ እና ተሳትፎ ማሳደግ።
    </p>
  </section>

  <!-- values section -->
  <section class="mb-5">
    <h2 class="mb-4">የተቋሙ እሴቶች</h2>
    <div class="row g-4">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
        <div class="icon-wrapper mx-auto mb-3">
          <i class="bi bi-eye fs-1 text-primary"></i>
        </div>
        <h5>ግልፅነት</h5>
      </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
        <div class="icon-wrapper mx-auto mb-3">
          <i class="bi bi-shield-lock fs-1 text-success"></i>
        </div>
        <h5>ተጠያቂነት</h5>
      </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
          <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-award fs-1 text-warning"></i>
          </div>
          <h5>የላቀ አገልግሎት መስጠት</h5>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
          <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-lightbulb fs-1 text-info"></i>
          </div>
          <h5>ለፈጠራ እና ለውጥ መነሳሳት</h5>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
          <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-shield-check fs-1 text-danger"></i>
          </div>
          <h5>የስራ ላይ ደህንነት</h5>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
          <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-briefcase fs-1 text-secondary"></i>
          </div>
          <h5>ሙያዊ ክብር እና ስነምግባር</h5>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
          <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-briefcase fs-1 text-secondary"></i>
          </div>
          <h5>ቅንነት</h5>
        </div>
      </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card text-center p-4 shadow-sm border-0 h-100 hover-shadow rounded-4">
        <div class="icon-wrapper mx-auto mb-3">
          <i class="bi bi-people fs-1 text-primary"></i>
        </div>
        <h5>በቡድን የመስራት ባህል</h5>
      </div>
    </div>
  </div>
</section>



  <!-- Team Section -->
 <section class="mb-5">
  <h2 class="mb-4">Our Team</h2>
  <div class="row g-4">
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="wakweya.jpg" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">ዋቅዋያ ጉዲሶ</h5>
          <p class="text-muted small mb-0">ሃላፊ</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="tigist.jpg" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">ትእግስት ተክሌ</h5>
          <p class="text-muted small mb-0">የማስታወቂያ ፍቃድና ክትትል ባለሙያ</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="image.png" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">Selam Tadesse</h5>
          <p class="text-muted small mb-0">Admin</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="image.png" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">Selam Tadesse</h5>
          <p class="text-muted small mb-0">Admin</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="image.png" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">Selam Tadesse</h5>
          <p class="text-muted small mb-0">Admin</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="image.png" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">Selam Tadesse</h5>
          <p class="text-muted small mb-0">Admin</p>
        </div>
      </div>
    </div>
    <!-- Team Member -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card h-100 text-center shadow-sm border-0">
        <img src="image.png" class="card-img-top" alt="Selam Tadesse" style="height: 220px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title mb-1">Selam Tadesse</h5>
          <p class="text-muted small mb-0">Admin</p>
        </div>
      </div>
    </div>

  </div>
</section>



  <!-- Feedback Form -->
  <section class="mb-5">
  <h2 class="mb-4 text-center">Feedback / Message to Admin</h2>
  <div class="d-flex justify-content-center">
    <form action="submit_feedback.php" method="POST" class="card p-4 shadow border-0 w-100" style="max-width: 600px;">
      <div class="mb-3">
        <label for="client_name" class="form-label fw-semibold">Your Name</label>
        <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter your name" required>
      </div>

      <div class="mb-3">
        <label for="message" class="form-label fw-semibold">Your Feedback or Message</label>
        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-send me-2"></i>Send Message
        </button>
      </div>
    </form>
  </div>
</section>

</main>

<!-- ✅ Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<!-- ✅ Footer -->
<footer class=" text-center py-4 mt-5">
  <div class="container">
    <p class="mb-1">© 2025 የወረዳ 11 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት</p>
    <p class="mb-0">Designed & Developed by IT Team | <a href="mailto:info@wereda11.gov.et" class="text-white text-decoration-underline">info@wereda11.gov.et</a></p>
  </div>
</footer>

</html>
