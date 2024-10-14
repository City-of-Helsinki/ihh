(function ($) {
  $(document).ready(function () {
    /**
     * AJAX filter functionality
     */
    $('.js-filter input[type="radio"]').on("change", function () {
      const filter = $("#filter");
      const statusSrOnly = $(".sr-only.status");
      const inputValue = $(this).val();

      $.ajax({
        url: filter.attr("action"),
        data: filter.serialize(),
        type: filter.attr("method"), // POST
        beforeSend: function () {
          statusSrOnly.text("Loading " + inputValue);
        },
        success: function (data) {
          $("#blog-posts-container").html(data);
        },
        error: function (result) {
          console.warn(result);
        },
        complete: function () {
          statusSrOnly.text("Loading " + inputValue + " completed");
        },
      });
      return false;
    });

    $('.js-filter-events input[type="radio"]').on("change", function () {
      const filter = $("#filter-events");
      const statusSrOnly = $(".sr-only.status");
      const inputValue = $(this).val();

      $.ajax({
        url: filter.attr("action"),
        data: filter.serialize(),
        type: filter.attr("method"), // POST
        beforeSend: function () {
          statusSrOnly.text("Loading " + inputValue);
        },
        success: function (data) {
          $("#blog-events-container").html(data);
        },
        error: function (result) {
          console.warn(result);
        },
        complete: function () {
          statusSrOnly.text("Loading " + inputValue + " completed");
        },
      });
      return false;
    });

    $("#past-events").hide();

    $("#show_past_events_btn").on("click", function (evt) {
      evt.preventDefault();
      $("#past-events").show();
      $("#show_past_events_btn").hide();
    });

    /*
     * Services target groups
     */

    $(".service_targetgroup_3").hide();

    $('.js-filter-service input[type="radio"]').on("change", function () {
      const inputValue = $(this).val();

      if (inputValue == 2) {
        $(".service_targetgroup_2").show();
        $(".service_targetgroup_3").hide();
      } else if (inputValue == 3) {
        $(".service_targetgroup_3").show();
        $(".service_targetgroup_2").hide();
      }

      return false;
    });

    /*
     * Load more
     */
    $(document).on("click", ".pagination a", function (evt) {
      evt.preventDefault();
      const btn = $(this);
      const page = btn.data("page");
      const nextPage = page + 1;

      const postsContainer = $("#blog-posts-container");
      const filter = $("#filter");
      const statusSrOnly = $(".sr-only.status");

      const url = new URL(btn.attr("href"));

      $.ajax({
        url: filter.attr("action"),
        data: filter.serialize() + "&paged=" + url.searchParams.get("paged"),
        type: "get",
        beforeSend: function () {
          statusSrOnly.text("Loading page" + url.searchParams.get("paged"));

          jQuery("html, body").animate({
            scrollTop: postsContainer.offset().top - 80,
          });
          postsContainer.focus();
        },
        success: function (result) {
          btn.data("page", nextPage);
          $("#blog-posts-container").html(result);
        },
        error: function (result) {
          console.warn(result);
        },
        complete: function () {
          statusSrOnly.text("Loading completed");
        },
      });
    });

    $(document).on("click", ".pagination-events a", function (evt) {
      evt.preventDefault();
      const btn = $(this);
      const page = btn.data("page");
      const nextPage = page + 1;

      const postsContainer = $("#blog-events-container");
      const filter = $("#filter-events");
      const statusSrOnly = $(".sr-only.status");

      const url = new URL(btn.attr("href"));
      const filterEvents = filter
        .serialize()
        .replace("&type=news", "&type=event");
      $.ajax({
        url: filter.attr("action"),
        data:
          filterEvents +
          "&paged-events=" +
          url.searchParams.get("paged-events"),
        type: "get",
        beforeSend: function () {
          statusSrOnly.text(
            "Loading page" + url.searchParams.get("paged-events")
          );

          jQuery("html, body").animate({
            scrollTop: postsContainer.offset().top - 80,
          });
          postsContainer.focus();
        },
        success: function (result) {
          btn.data("page", nextPage);
          $("#blog-events-container").html(result);
        },
        error: function (result) {
          console.warn(result);
        },
        complete: function () {
          statusSrOnly.text("Loading completed");
        },
      });
    });

    $('a[href^="#openchat"]').each(function () {
      var oldUrl = $(this).attr("href");
      var newUrl = oldUrl.replace(
        "#chat",
        "javascript:window.acaWidget.__open();"
      );
      $(this).attr("href", newUrl);
    });

    $(".submenu .nav-link").click(function () {
      var id = $(this).attr("id");
      if ($(window).width() < 1101) {
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          250
        );
      }
      $(".mobile-search")
        .find(".quick-links")
        .removeClass("mobile-quick-links-show");
      if ($(this).attr("aria-expanded") == "false") {
        $("." + id).addClass("mobile-quick-links-show");
      }
    });
  });
})(jQuery);
