$(document).ready(function () {
  var app = $.spapp({
    defaultView: "#home",
    templateDir: "./views/",
    pageNotFound: "error_404"
  });

  app.route({ view: "home", load: "home.html" });
  app.route({ view: "about", load: "about.html" });
  app.route({ view: "events", load: "events.html" });
  app.route({ view: "login", load: "login.html" });
  app.route({ view: "register", load: "register.html" });
  app.route({ view: "dashboard", load: "dashboard.html" });
  app.route({ view: "profile", load: "profile.html" });
  app.route({ view: "admin-events", load: "admin-events.html" });
  app.route({ view: "contact", load: "contact.html" });

  app.run();

  let savedName = localStorage.getItem("userName");
  if (savedName) {
    $("#userName").text(savedName);
    $("#userDropdown").show();
  } else {
    $("#userDropdown").hide();
  }

  $(document).on("submit", "#loginForm", function (e) {
    e.preventDefault();
    let email = $("#loginEmail").val().trim();
    let password = $("#loginPassword").val().trim();
    if (email && password) {
      let username = email.split("@")[0];
      localStorage.setItem("userName", username);
      $("#userName").text(username);
      $("#userDropdown").show();
      window.location.hash = "#home";
      $("#loginMessage").text("Login successful!").css("color", "green").show();
    } else {
      $("#loginMessage").text("Please fill in all fields.").css("color", "red").show();
    }
  });

  $(document).on("submit", "#registerForm", function (e) {
    e.preventDefault();
    let name = $("#regName").val().trim();
    let email = $("#regEmail").val().trim();
    let password = $("#regPassword").val().trim();
    if (name && email && password) {
      $("#registerMessage").text("Registration successful!").css("color", "green").show();
    } else {
      $("#registerMessage").text("Please fill in all fields.").css("color", "red").show();
    }
  });

  $(document).on("submit", "#reviewForm", function (e) {
    e.preventDefault();
    let name = $("#reviewName").val().trim();
    let text = $("#reviewText").val().trim();
    let rating = $("#reviewRating").val();
    if (name && text && rating) {
      let stars = "⭐".repeat(rating);
      let newReview = `<li class=\"mb-2\">${stars} – \"${text}\" – <strong>${name}</strong></li>`;
      $("#reviewList").append(newReview);
      $("#reviewForm")[0].reset();
      $("#reviewMsg").show().delay(2000).fadeOut();
    }
  });

  $(document).on("click", "#logoutBtn", function(e) {
    e.preventDefault();
    localStorage.removeItem("userName");
    $("#userName").text("");
    $("#userDropdown").hide();
    window.location.hash = "#login";
    alert("You have been logged out.");
  });

  const themeBtn = $("#themeToggle");

  function setTheme(mode) {
    $("body").removeClass("light-mode dark-mode").addClass(mode);
    localStorage.setItem("theme", mode);
    themeBtn.text(mode === "dark-mode" ? "☀️ Light Mode" : "🌙 Dark Mode");
  }

  let savedTheme = localStorage.getItem("theme") || "light-mode";
  setTheme(savedTheme);

  themeBtn.on("click", function () {
    const newTheme = $("body").hasClass("dark-mode") ? "light-mode" : "dark-mode";
    setTheme(newTheme);
  });
});