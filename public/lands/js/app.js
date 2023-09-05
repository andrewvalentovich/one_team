function changerActive(list) {
  for(let i = 0; i < list.length; i++) {
      list[i].classList.remove('active')
  }
  list = 0
}


function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min)
}


//Popup close 
document.addEventListener("click", function(event) {
  event = event || window.event;
  let target = event.target

  if(target.classList.contains('popup')) {
    target.classList.remove('active')
    bodyScrollLock.enableBodyScroll(target);
    stopVideoPopup()
  }

  //закрытие меню кликом по темной области
  if(target.classList.contains('header-m')) {
    target.classList.remove('active')
    bodyScrollLock.enableBodyScroll(target);
    for (let i = 0; i < headerMenuBtn.length; i++) {
      headerMenuBtn[i].classList.toggle('open')
    }
  }


  //закрытие блоков close-out по клику вне 
  if(!target.classList.contains('close-out') && !target.closest('.close-out')) {
    const closeOutBlock = document.querySelectorAll('.close-out')
    $( '.sort__list' ).slideUp( "slow", function() {});
    changerActive(closeOutBlock)
  }
}

)

function stopVideoPopup() {
  const video = document.querySelector('.popup-video__iframe');
  if (video) {
    const videoSrc = video.getAttribute('src');
    video.setAttribute('src', videoSrc); // Это перезагрузит iframe и остановит видео
  }
}

//событие scroll у документа 
const headerW = document.querySelector('.header-w')
document.addEventListener("scroll", function(event) {
  if(window.pageYOffset) {
    headerW.classList.add('sticky')
  } else {
    headerW.classList.remove('sticky')
  }
})

if(window.pageYOffset) {
  headerW.classList.add('sticky')
} else {
  headerW.classList.remove('sticky')
}

let popupClose = document.querySelectorAll('.popup-close')
for(let i=0 ; i < popupClose.length ; i++) {
    popupClose[i].addEventListener("click",
    function() {
      let popup = popupClose[i].closest('.popup')
        popup.classList.remove('active')
        stopVideoPopup()
        bodyScrollLock.enableBodyScroll(popup);
    })
}


//скролл до блока по клику на ссылку
$(document).ready(function () {
  $('a[href^="#"]').on('click', function (event) {
      if(!this.classList.contains('scroll')) return
      event.preventDefault();
      const target = $(this.getAttribute('href'));
      if (target.length) {
          $('html, body').stop().animate({
              scrollTop: target.offset().top - headerW.offsetHeight
          }, 1000);
      }
      if (this.closest('.header-m')) {
        toggleMobileMenu()
      }
  });
});


//открытие sort блока
if(document.querySelectorAll('.sort').length) {
  const sort = document.querySelectorAll('.sort')
  sort.forEach(sortBlock => {
    sortBlock.addEventListener('click', function(e) {
      const target = e.target
      const dropDown = sortBlock.querySelector('.sort__list')
      //открытие по title 
      if(target.classList.contains('sort__title') || target.closest('.sort__title')) {
        const closeOutBlock = document.querySelectorAll('.close-out')

        if(sortBlock.classList.contains('active')) {
          changerActive(closeOutBlock)
          $( dropDown ).slideUp( "slow", function() {});
        } else {
          changerActive(closeOutBlock)
          $( '.sort__list' ).slideUp( "slow", function() {});
          $( dropDown ).slideDown( "slow", function() {});
          sortBlock.classList.add('active')
        }
        return
      }
      if(target.classList.contains('sort__list-item') || target.closest('.sort__list-item')) {
        const itemClicked = target.closest('.sort__list-item')
        const text = itemClicked.querySelector('span').innerHTML.trim()
        const title = sortBlock.querySelector('.sort__title').querySelector('span')
        title.innerHTML = text
        $( dropDown ).slideUp( "slow", function() {});
        sortBlock.classList.remove('active')
        return
      }
    })
  });
}


//бургер меню
let headerMenuBtn = document.querySelectorAll('.toggle-menu')
let mobileMenu = document.querySelector('.header-m')
for (let i = 0; i < headerMenuBtn.length; i++) {
  headerMenuBtn[i].addEventListener('click', function() {
    toggleMobileMenu()
  })
}

function toggleMobileMenu() {
  for (let i = 0; i < headerMenuBtn.length; i++) {
    headerMenuBtn[i].classList.toggle('open')
  }
  mobileMenu.classList.toggle('active')
}

// Size-control
window.addEventListener('resize', function(event){
  if(window.innerWidth >= 1024 && mobileMenu !== null) {
    mobileMenu.classList.remove('active')
    for (let i = 0; i < headerMenuBtn.length; i++) {
      headerMenuBtn[i].classList.remove('open')
    }
  }
})

//header-touch-swipe
function hedearMobileSwipeClose() {
  const headerMobile = document.querySelector('.header-m')
  const headerMobileContent = headerMobile.querySelector('.header-m__content')


  headerMobileContent.addEventListener('touchstart', handleTouchStart, false);
  headerMobileContent.addEventListener('touchmove', handleTouchMove, false);
  
  let xDown = null;
  let yDown = null;
  
  function handleTouchStart(evt) {
      xDown = evt.touches[0].clientX;
      yDown = evt.touches[0].clientY;
  };
  
  function handleTouchMove(evt) {
      if ( ! xDown || ! yDown ) {
          return;
      }
  
      let xUp = evt.touches[0].clientX;
      let yUp = evt.touches[0].clientY;
  
      let xDiff = xDown - xUp;
      let yDiff = yDown - yUp;
      if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
          if ( xDiff > 0 ) {
            headerMobile.classList.remove('active')
            for (let i = 0; i < headerMenuBtn.length; i++) {
              headerMenuBtn[i].classList.toggle('open')
            }
            bodyScrollLock.enableBodyScroll(headerMobile);
          } else {
          }
      } else {
          if ( yDiff > 0 ) {
          } else {
          }
      }
      xDown = null;
      yDown = null;
  
  };
}
if(document.querySelectorAll('.header-m').length) {
  hedearMobileSwipeClose()
}


//свайпер about
const aboutSwiper = new Swiper('.about__swiper', {
  slidesPerView: 1,
  pagination: {
    el: ".about__pagination",
    type: "fraction",
  },
  navigation: {
    nextEl: ".about__next",
    prevEl: ".about__prev",
  },
})


//свайпер с планировками
const layoutsSwiper = new Swiper('.layouts__swiper', {
  slidesPerView: 3,
  spaceBetween: 40,
  pagination: {
    el: ".layouts__pagination",
    clickable: true,
  },
  autoplay: {
    delay: 3000,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    540: {
      slidesPerView: 2,
      spaceBetween: 25,
    },
    1024: {
      slidesPerView: 3,
    }
  }
})


//свайпер gallery
const gallerySwiper = new Swiper('.gallery__swiper', {
  spaceBetween: 20,
  loop: true,
  navigation: {
    nextEl: ".gallery__next",
    prevEl: ".gallery__prev",
  },
  pagination: {
    el: ".gallery__pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    540: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    1350: {
      slidesPerView: 3,
    }
  }
})


//смена контента в галерее

if(document.querySelectorAll('.gallery__item')) {
  const galleryItem = document.querySelectorAll('.gallery__item')
  galleryItem.forEach((galleryBtn, index) => {

    galleryBtn.addEventListener('click', function() {

      if(galleryBtn.classList.contains('gallery__item_video')) return

      if(galleryBtn.classList.contains('building-select')) {
        let randomNumber = randomIntFromInterval(1,4)

        if(galleryBtn.classList.contains('all')) randomNumber = -1
        randomStatebuildingCards(randomNumber)
      }

      changerActive(galleryItem)
      galleryBtn.classList.add('active')
      changeContentGallerySwiper(index)
    })
  })
}

//временная функция чтобы показать смену контента в галерее 
function changeContentGallerySwiper(numberBtn) {
  const swiperGallery = document.querySelector('.gallery__swiper')
  const swiperWrapper = swiperGallery.querySelector('.gallery__swiper-wrapper')
  swiperWrapper.innerHTML = ''
  for (let i = 0; i < 6; i++) {
    let numberPhoto = numberBtn
    if(numberBtn === 0 || numberBtn >=4) numberPhoto = 1

    gallerySwiper.addSlide(i, `<a href="./img/pic/gallery-${numberPhoto}.png" class="gallery__slide swiper-slide" data-fancybox><img src="./img/pic/gallery-${numberPhoto}.png" alt=""></a>`)
  }
  gallerySwiper.update()
  gallerySwiper.updateSlides()
}


//свайпер новостроек bulding
const buildingSwiper = new Swiper('.building__item-swiper', {
  slidesPerView: 1,
  scrollbar: {
    el: ".building__item-scrollbar",
    hide: false,
    draggable: true,
  },
})


//временная функция для смены карточек building__item
function randomStatebuildingCards(randomNumber) {
  const cards = document.querySelectorAll('.building__item')
  const cardsList = document.querySelectorAll('.building__item')

  cards.forEach(card => {
    card.style.display = 'block'
  });


  for (let i = 0; i <= randomNumber; i++) {
    cards[i].style.display = 'none'
  }

}


//свайп при ховере мышки
if(document.querySelectorAll('.building__item-swiper').length) {
  const swipers = document.querySelectorAll('.building__item-swiper')
  for(let i = 0; i < swipers.length; i++) {
    addHoverMouseSwiper(swipers[i],i)
  }

  function addHoverMouseSwiper (swiper,index) {
    const slides = swiper.querySelectorAll('.building__item-slide')
    const width = 1 / slides.length * 100
    for(let i = 0; i < slides.length; i++) {
      let newDiv = document.createElement("i");
      swiper.append(newDiv)
      newDiv.style.width = width + '%'
      newDiv.style.left = width * i + '%'
      newDiv.addEventListener('mouseover', function() {
        buildingSwiper[index].slideTo(i, 400)
      })
    }
  }
}


//открытие модалок
//open-record-btn дефолтная модалка
const recordPopup = document.querySelector('.popup-record')
if(document.querySelectorAll('[btn-popup]').length) {
  const popupBtnOpen = document.querySelectorAll('[btn-popup]')
  popupBtnOpen.forEach(btn => {
    btn.addEventListener('click', function() {
      const namePopup = btn.getAttribute('btn-popup')
      const popupToOpen = document.querySelector(`.${namePopup}`)
      popupToOpen.classList.add('active')
      bodyScrollLock.disableBodyScroll(popupToOpen);
    })
  });
}


//галерея 
$(document).ready(function() {
  $('[data-fancybox]').fancybox({
    // Настройки Fancybox, если необходимо
  });
});



