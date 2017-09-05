<?php

/**
 * @file
 * Lists available colors and color schemes for the AT Starterkit.
 * By default the color scheme relies almost entirely on color
 * shift, where the user changes the base color and all other
 * unspecified colors shift relative to the new base.
 */

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'base'        => t('Base'),
    'text'        => t('Text color'),
    'link'        => t('Link color'),
    'headerstart' => t('Header top'),
    'headerstop'  => t('Header bottom'),
    'headercolor' => t('Header text'),
    'navbar'      => t('Navbar'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Ocean Water'),
      'colors' => array(
        'base'        => '#000000',
        'text'        => '#404040',
        'link'        => '#056fcb',
        'headerstart' => '#0461b2',
        'headerstop'  => '#58bdf5',
        'headercolor' => '#fcfcfc',
        'navbar'      => '#035399',
      ),
    ),
    'forestgreen' => array(
      'title' => t('Forest Green'),
      'colors' => array(
        'base'        => '#1d7e17',
        'text'        => '#404040',
        'link'        => '#186813',
        'headerstart' => '#0e3d0b',
        'headerstop'  => '#1d7e17',
        'headercolor' => '#fcfcfc',
        'navbar'      => '#092707',
      ),
    ),
    'redcarpet' => array(
      'title' => t('Red Carpet'),
      'colors' => array(
        'base'        => '#b61c0c',
        'text'        => '#383838',
        'link'        => '#9e190b',
        'headerstart' => '#861509',
        'headerstop'  => '#b61c0c',
        'headercolor' => '#fcfcfc',
        'navbar'      => '#6e1107',
      ),
    ),
    'silver' => array(
      'title' => t('Silver'),
      'colors' => array(
        'base'        => '#a7aab3',
        'text'        => '#a9a9a9',
        'link'        => '#666a75',
        'headerstart' => '#8c909b',
        'headerstop'  => '#a7aab3',
        'headercolor' => '#fcfcfc',
        'navbar'      => '#717683',
      ),
    ),
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'styles/css/components/color.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.svg',
    'logo.png',
  ),

  // Gradient definitions.
  'gradients' => array(),
);
