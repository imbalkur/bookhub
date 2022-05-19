function addBookDropdown() {
  document.getElementById("addbook").classList.toggle("show");
}

function userDropdown() {
  document.getElementById("myorder").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

$(function() {
    $('.admin').hover((e) => {
        document.getElementById("addbook").classList.toggle("show");
    });
    $('.addbook').hover((e) => {
        document.getElementById("addbook").classList.toggle("show");
    });

    $('.account').hover((e) => {
        document.getElementById("myorder").classList.toggle("show");
    });

    $(".quantity").keypress(function(e) {
        e.preventDefault();
    });

    // cart update quantity
    $('.update-cart').change((e) => {
        // console.log(e.target.value)
        e.preventDefault();

        let quantity = e.target.value;
        let cartid = e.target.dataset.id;
        console.log(cartid);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/updateCart",
            type: "POST",
            data: {
                id: cartid,
                quantity: quantity
            },
            success: function(response) {
                // console.log(response)
                location.reload();
            }
        })
    })

    // cart checkbox update
    $('.buy').click((e) => {
        console.log(e.target.checked)
        // e.preventDefault();

        let is_checked = e.target.checked;
        let cartid = e.target.dataset.id;
        console.log(cartid);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/updateCart",
            type: "POST",
            data: {
                id: cartid,
                is_checked: is_checked,
                check: 1
            },
            success: function(response) {
                // console.log(response)
                location.reload();
            }
        })
    });

    $('.checkRemove').click((e) => {
        // e.preventDefault();

        let is_checked = false;
        let cartid = e.target.dataset.id;
        console.log(cartid);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/updateCart",
            type: "POST",
            data: {
                id: cartid,
                is_checked: is_checked,
                check: 1
            },
            success: function(response) {
                // console.log(response)
                location.reload();
            }
        })
    });
})