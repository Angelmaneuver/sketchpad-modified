import * as del      from 'del';
import gulp          from 'gulp';
import plumber       from 'gulp-plumber';
import * as dartSass from 'sass';
import gulpSass      from 'gulp-sass';
import cleanCss      from 'gulp-clean-css';
import rename        from 'gulp-rename';
import autoprefixer  from 'gulp-autoprefixer';

const sass = gulpSass(dartSass);

function compileWithNotMinify(srcPath, destPath, includePaths) {
	return gulp.src(srcPath)
	.pipe(plumber())
	.pipe(sass.sync({ includePaths: includePaths }))
	.pipe(autoprefixer())
	.pipe(gulp.dest(destPath))
}

function compile(srcPath, destPath, includePaths) {
	return gulp.src(srcPath, { sourcemaps: true })
	.pipe(plumber())
	.pipe(sass.sync({ includePaths: includePaths }))
	.pipe(autoprefixer())
	.pipe(rename({ extname: '.min.css' }))
	.pipe(cleanCss())
	.pipe(gulp.dest(destPath))
}

function clear(paths) {
	if(paths instanceof String) {
		del(paths);
	} else if(Array.isArray(paths)) {
		paths.foreach((element) => {
			del(element);
		} );
	}
}

function style() {
	return compileWithNotMinify(
		'./assets/stylesheets/sass/src/style.scss',
		'./',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
			'./assets/stylesheets/sass/src/block',
		],
	);
}

function style_admin() {
	return compile(
		'./assets/stylesheets/sass/src/admin/style_admin.scss',
		'./assets/stylesheets/css/admin',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
		],
	);
}

function block_editor_style() {
	return compile(
		'./assets/stylesheets/sass/src/editor/block_editor_style.scss',
		'./assets/stylesheets/css/editor',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/editor',
			'./assets/stylesheets/sass/preset',
		],
	);
}

function embed_template() {
	return compile(
		'./assets/stylesheets/sass/src/embed/embed-template.scss',
		'./assets/stylesheets/css/embed',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/embed',
			'./assets/stylesheets/sass/preset',
		],
	);
}

function theme() {
	return compile(
		'./assets/stylesheets/sass/src/theme/**/*.scss',
		'./assets/stylesheets/css/theme',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/theme',
			'./assets/stylesheets/sass/preset',
		],
	);
}

function blocks() {
	clear('./assets/stylesheets/css/core');

	return compile(
		'./assets/stylesheets/sass/src/block/**/*.scss',
		'./assets/stylesheets/css',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
			'./assets/stylesheets/sass/src/block',
		],
	);
}

function user() {
	return compile(
		'./assets/stylesheets/sass/user/**/*.scss',
		'./user/css',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
			'./assets/stylesheets/sass/src/block',
		],
	);
}

function watchFiles() {
	gulp.watch([
		'./assets/stylesheets/sass/src/style.scss',
		'./assets/stylesheets/sass/src/style/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], style);

	gulp.watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/admin/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], style_admin);

	gulp.watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/editor/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], block_editor_style);

	gulp.watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/embed/embed-template.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], embed_template);

	gulp.watch([
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/src/theme/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], theme);

	gulp.watch([
		'./assets/stylesheets/sass/src/block/**/*.scss',
		'./assets/stylesheets/sass/src/block/**/**/*.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], blocks);

	gulp.watch([
		'./assets/stylesheets/sass/user/**/*.scss',
		'./assets/stylesheets/sass/src/_define.scss',
		'./assets/stylesheets/sass/preset/**/*.scss',
	], user);
}

const build = gulp.series(
	gulp.parallel([
		style,
		style_admin,
		block_editor_style,
		embed_template,
		theme,
		blocks,
		user,
	]),
	watchFiles
);

export default build;
