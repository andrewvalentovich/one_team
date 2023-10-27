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

  toggleActivePopupSwiper()

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
  navigation: {
    nextEl: '.layouts__next',
    prevEl: '.layouts__prev',
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

$(document).ready(function () {

})
//свайпер gallery
const gallerySwiper = new Swiper('.gallery__swiper', {
  spaceBetween: 20,
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
      newDiv.classList.add('iHover')
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
      if(namePopup === 'popup-house') {
        const house = btn.closest('.layouts__slide')
        createHouseInfoPopup(house)
      }
    })
  });
}
const objectSwiper = new Swiper('.object__swiper', {
  slidesPerView: 1,
  navigation: {
      nextEl: '.object__swiper-next',
      prevEl: '.object__swiper-prev',
  },
  pagination: {
      el: ".object__swiper-pagination",
      clickable: true,
  },
  breakpoints: {
      320: {

      },
      480: {

      },
      640: {

      }
  }
})
function createHouseInfoPopup(house) {
  const price = house.querySelector('.layouts__slide-price').innerHTML
  const lead = house.querySelector('.layouts__slide-lead').innerHTML
  const pic = house.querySelector('.layouts__slide-pic')

  const swiperWrapper = document.querySelector(".object__swiper-wrapper");
  const objectSwiperNav = document.querySelectorAll(".object__swiper-nav");

  const popup = document.querySelector('.popup-house')
  const srsForPhotos = pic.getAttribute('data-photos')
  const popupPrice = popup.querySelector('.popup__house-price')
  const popupLead = popup.querySelector('.popup__house-lead')
  const month = popup.querySelector('.popup__house-month')


  const priceWithoutEuro = parseFloat(price.replace('€', ''));
  const priceMonth = priceWithoutEuro / 48;
  
  const formattedPrice = addThousandSeparators(priceMonth.toFixed(2));
  
  

  
  popupPrice.innerHTML = price
  popupLead.innerHTML = lead
  month.innerHTML = `${formattedPrice}  € / мес`

  const photoArray = JSON.parse(srsForPhotos);
  console.log(photoArray)

  swiperWrapper.innerHTML = ''
  photoArray.forEach(photo => {
      const slide = document.createElement('div')
      const slidePic = document.createElement('img')

      if(photo.name) {
          const floor = document.createElement('div')
          floor.classList.add('object__swiper-slide-floor')
          floor.innerHTML = photo.name
          slide.appendChild(floor)
      }
      
      slide.classList.add('swiper-slide')
      slide.classList.add('object__swiper-slide')
      slide.appendChild(slidePic)
      slidePic.setAttribute('src', photo.url)
      swiperWrapper.appendChild(slide)

  });

  if(photoArray.length <= 1) {
    objectSwiperNav.forEach(btn => {
        btn.style.display = 'none'
    });
  } else {
    objectSwiperNav.forEach(btn => {
        btn.style.display = 'flex'
    });
  }

  objectSwiper.update()
  objectSwiper.updateSlides()
  objectSwiper.slideTo(0)
}

function addThousandSeparators(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}



//анимация инпутов
const inputWrappers = document.querySelectorAll('.input-wrapper');

function toggleInput(input) {
    const parentWrapper = input.parentElement.closest('.input-wrapper');
    if (input === document.activeElement || parentWrapper.classList.contains('active')) {
        parentWrapper.classList.add('active');
    } else if (input.value !== '') {
        parentWrapper.classList.remove('active');
    }
}

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    toggleInput(input);
    input.addEventListener('input', function() {
        toggleInput(input);
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('focus', function() {
        inputWrappers.forEach(function(label) {
            const labelInput = label.querySelector('input');
            if (!labelInput.value) {
                label.classList.remove('active');
                label.classList.remove('confirm');
            }
        });
        wrapper.classList.add('active');
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('click', function() {
        wrapper.classList.add('active');
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('blur', function() {
        if(input.value) {
            if(input.getAttribute('name') === 'phone') {
                if(input.value.length <= 5) {
                    wrapper.classList.remove('confirm');
                    return
                }
            }
            wrapper.classList.add('confirm');
        } else {
            wrapper.classList.add('border');
        }
    });
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.input-wrapper')) {
        inputWrappers.forEach(function(wrapper) {
            const input = wrapper.querySelector('input');
            if (!input.value) {
                wrapper.classList.remove('active');
            }
        });
    }
});


//галерея
if(document.querySelectorAll('.gallery__slide').length) {
  addClickOpenGallery()
}

let popupGallerySwiper
if(document.querySelectorAll('.popup__swiper').length) {
  //свайпер about
  popupGallerySwiper = new Swiper('.popup__swiper', {
    slidesPerView: 1,
    navigation: {
      nextEl: ".popup__next",
      prevEl: ".popup__prev",
    },
    keyboard: true,
    pagination: {
      el: ".popup__swiper-pagination",
      type: "custom",
      renderCustom: function (e, t, o) {
          return t + " из " + o
      }
    },
  })
}

function addClickOpenGallery() {
  const gallerySlide = document.querySelectorAll('.gallery__slide')
  gallerySlide.forEach((pic, index) => {
    pic.addEventListener('click', function() {
      addPhotosPopupSwiper(index)
      const popupGallery = document.querySelector('.popup-gallery')
      popupGallery.classList.add('active')
      bodyScrollLock.disableBodyScroll(popupGallery);
    })
  });
}


function addPhotosPopupSwiper(slideNumber) {
  const swiperGallery = document.querySelector('.popup__swiper')
  const swiperWrapper = swiperGallery.querySelector('.popup__swiper-wrapper')

  const photos = document.querySelectorAll('.gallery__slide')
  swiperWrapper.innerHTML = ''
  for (let i = 0; i < photos.length; i++) {
    const img = photos[i].querySelector('img')
    popupGallerySwiper.addSlide(i, `<div class="popup__slide swiper-slide"><img src=${img.getAttribute('src')} alt=${img.getAttribute('alt')}></div>`)
  }
  popupGallerySwiper.update()
  popupGallerySwiper.updateSlides()
  popupGallerySwiper.slideTo(slideNumber)
}

function toggleActivePopupSwiper() {
  console.log(popupGallerySwiper)
  if(popupGallerySwiper ) {
    if(window.innerWidth <= 540) {
      popupGallerySwiper.disable()
    }
    else {
      popupGallerySwiper.enable()
    }
  }
}

toggleActivePopupSwiper()

if (document.querySelectorAll('.building__list').length) {
  console.log('test')
  const buildingList = document.querySelector('.building__list')
  buildingList.addEventListener('click', function(e) {
    const target = e.target
    if(target.classList.contains('building__item') || target.closest('.building__item')) {
      const buildingPopup = document.querySelector('.popup-building')
      buildingPopup.classList.add('active')
      bodyScrollLock.disableBodyScroll(buildingPopup);

      const houseBlock = target.closest('.building__item')
      addBuldingToPopup(houseBlock)
    }
  })
}

function addBuldingToPopup(houseBlock) {
  const popupBuildingInfo = document.querySelector('.popup__building-info')
  popupBuildingInfo.innerHTML = ''
  popupBuildingInfo.appendChild(houseBlock.cloneNode(true))

  const swiper = popupBuildingInfo.querySelector('.building__item-swiper')
  swiper.classList.add('newSwiper')
  //свайпер новостроек bulding
  const buildingSwiper = new Swiper('.newSwiper', {
    slidesPerView: 1,
    scrollbar: {
      el: ".building__item-scrollbar",
      hide: false,
      draggable: true,
    },
  })
  buildingSwiper.slideTo(1, 0)
  buildingSwiper.slideTo(0, 0)

  const iHover = popupBuildingInfo.querySelectorAll('.iHover')
  iHover.forEach((element, index) => {
    element.addEventListener('mouseover', function() {
      buildingSwiper.slideTo(index, 400)
    })
  });
}


const wrapMap = document.querySelectorAll('.wrapMap')
const popupMap = document.querySelector('.popup-map')
const popupMapBody = popupMap.querySelector('.popup-map__body')
wrapMap.forEach(map => {
  const iframe = map.querySelector('iframe')
  const iframeClone = (iframe.cloneNode(true))
  const wrapClick = document.createElement('div')
  wrapClick.classList.add('myWrapClick')
  map.appendChild(wrapClick)
  wrapClick.addEventListener('click', function() {
    popupMap.classList.add('active')
    bodyScrollLock.disableBodyScroll(popupMap);
    if(!popupMap.querySelector('iframe')) {
      popupMapBody.appendChild(iframeClone)
    }
  })
});


if(document.querySelectorAll('.changeGallery[data-category-id]').length) {
  const catogiesSelect = document.querySelectorAll('.changeGallery[data-category-id]');
  catogiesSelect.forEach(selector => {
    selector.addEventListener('click', function() {
      const id = selector.getAttribute('data-category-id')
      changerActive(catogiesSelect)
      this.classList.add('active')
      changeContentGallerySwiper(id)
    })
  });
}

function changeContentGallerySwiper(id) {
  const swiperGallery = document.querySelector('.gallery__swiper')
  const swiperWrapper = swiperGallery.querySelector('.gallery__swiper-wrapper')
  const swiperSlides = swiperWrapper.querySelectorAll('.gallery__slide')
  if(id == 0) {
    swiperSlides.forEach(slide => {
      slide.classList.remove('hidden-slide')
    });
  } else {
    for (let index = 0; index < swiperSlides.length; index++) {
      const idCategorySlide = swiperSlides[index].getAttribute('data-category-id')
      if(idCategorySlide != id) {
        swiperSlides[index].classList.add('hidden-slide');
      } else {
        swiperSlides[index].classList.remove('hidden-slide')
      }
    }
  }
  gallerySwiper.update()
  gallerySwiper.updateSlides()
  addClickOpenGallery()
  const galleryW = document.querySelector('.gallery__swiper-w')
  const galleryText = document.querySelector('.gallery__text')
  const gallery = document.querySelector('.gallery')

  if(swiperWrapper.querySelectorAll('.hidden-slide').length === swiperSlides.length) {
    galleryW.style.display = 'none'
    galleryText.style.display = 'block'
    gallery.style.overflow = 'visible'
  } else {
    galleryW.style.display = 'block'
    galleryText.style.display = 'none'
    gallery.style.overflow = 'hidden'
  }
}


function validate(inputElement) {
  console.log(inputElement);
  inputElement.value = inputElement.value.replace(/[0-9]+/g, '');
}
