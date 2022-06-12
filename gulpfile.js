"use strict";

const del          = require('del');
const {
	src,
	dest,
	watch,
	series,
	parallel
}                  = require('gulp');
const plumber      = require('gulp-plumber');
const sass         = require('gulp-sass')(require('sass'));
const cleanCss     = require('gulp-clean-css');
const rename       = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');

function compileWithNotMinify(srcPath, destPath, includePaths, done) {
	src(srcPath)
	.pipe(plumber())
	.pipe(sass.sync({ includePaths: includePaths }))
	.pipe(autoprefixer())
	.pipe(dest(destPath))

	done();
}

function compile(srcPath, destPath, includePaths, done) {
	src(srcPath, { sourcemaps: true })
	.pipe(plumber())
	.pipe(sass.sync({ includePaths: includePaths }))
	.pipe(autoprefixer())
	.pipe(rename({ extname: '.min.css' }))
	.pipe(cleanCss())
	.pipe(dest(destPath, { sourcemaps: '.' }))

	done();
}

function watcher(checkPaths, compiler, done) {
	watch(checkPaths, compiler);

	done();
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

const style = (done) => {
	compileWithNotMinify(
		'./assets/stylesheets/sass/src/style.scss',
		'./',
		'./assets/stylesheets/sass/preset',
		done
	);
}

const style_admin = (done) => {
	compile(
		'./assets/stylesheets/sass/src/admin/style_admin.scss',
		'./assets/stylesheets/css/admin',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
		],
		done
	);
}

const block_editor_style = (done) => {
	compile(
		'./assets/stylesheets/sass/src/editor/block_editor_style.scss',
		'./assets/stylesheets/css/editor',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/editor',
			'./assets/stylesheets/sass/preset',
		],
		done
	);
}

const embed_template = (done) => {
	compile(
		'./assets/stylesheets/sass/src/embed/embed-template.scss',
		'./assets/stylesheets/css/embed',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/embed',
			'./assets/stylesheets/sass/preset',
		],
		done
	);
}

const theme = (done) => {
	compile(
		'./assets/stylesheets/sass/src/theme/**/*.scss',
		'./assets/stylesheets/css/theme',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/src/theme',
			'./assets/stylesheets/sass/preset',
		],
		done
	);
}

const blocks = (done) => {
	clear('./assets/stylesheets/css/core');

	compile(
		'./assets/stylesheets/sass/src/block/**/*.scss',
		'./assets/stylesheets/css',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
			'./assets/stylesheets/sass/src/block',
		],
		done
	);
}

const user = (done) => {
	compile(
		'./assets/stylesheets/sass/user/**/*.scss',
		'./user/css',
		[
			'./assets/stylesheets/sass/src',
			'./assets/stylesheets/sass/preset',
		],
		done
	);
}

exports.compile = parallel([
	series(
		style,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/style.scss',
				'./assets/stylesheets/sass/src/style/**/*.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], style, done);
		}
	),

	series(
		style_admin,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/_define.scss',
				'./assets/stylesheets/sass/src/admin/**/*.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], style_admin, done);
		}
	),

	series(
		block_editor_style,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/_define.scss',
				'./assets/stylesheets/sass/src/editor/**/*.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], block_editor_style, done);
		}
	),

	series(
		embed_template,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/_define.scss',
				'./assets/stylesheets/sass/src/embed/embed-template.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], embed_template, done);
		}
	),

	series(
		theme,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/_define.scss',
				'./assets/stylesheets/sass/src/theme/**/*.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], theme, done);
		}
	),

	series(
		blocks,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/src/block/**/*.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], blocks, done);
		}
	),

	series(
		user,
		(done) => {
			watcher([
				'./assets/stylesheets/sass/user/**/*.scss',
				'./assets/stylesheets/sass/src/_define.scss',
				'./assets/stylesheets/sass/preset/**/*.scss',
			], user, done);
		}
	),
]);
