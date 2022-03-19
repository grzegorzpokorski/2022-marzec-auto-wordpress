import 'bootstrap';
import { tns } from "./../../node_modules/tiny-slider/src/tiny-slider";

const galleryInit = () => {
	const sections = document.querySelectorAll('.gallery');

	sections.forEach(section => {
		const slider = section.querySelector('.gallery__content');
		const controls = section.querySelector('.gallery__controls');

		const heroSlider = tns({
			container: slider,
			controls: true,
			nav: true,
			controlsContainer: controls,
			mode: 'carousel',
			slideBy: 'page',
			navPosition: 'bottom',
			mouseDrag: true,
			autoWidth: true,
			autoHeight: true,
			speed: 350,

			responsive: {
				768: {
					autoWidth: false,
				},
			}
		});
	});
}

if(document.querySelectorAll('.gallery')){
	galleryInit();
}

// import 'glightbox/dist/js/glightbox';
// import GLightbox from 'glightbox';

const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    autoplayVideos: true
});