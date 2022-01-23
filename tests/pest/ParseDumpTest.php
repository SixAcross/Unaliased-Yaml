<?php
declare(strict_types=1);
namespace SixAcross\Yaml\Tests;

use SixAcross\Yaml\Unaliased as Yaml;


it( 'parses and dumps yaml round-trip, twice, while preserving anchors, aliases, and merge keys. ',
    function( string $yaml ) {

        foreach ( [ 1, 2, ] as $round ) {
            $parser = new Yaml\Parser;
            $tree = $parser->parse( $yaml, Yaml::PARSE_CUSTOM_TAGS );
            $dumper = new Yaml\Dumper;
            $yaml = $dumper->dump( $tree, 99 );
        }
        
        $this->assertMatchesTextSnapshot($yaml);
    }
    
  )->with([
      <<<'ENDYAML'
          
          anchors:
              block:
                  sequence: &block_sequence_anchor 
                      - 9
                      - 6
                      - 3
                  map: &block_map_anchor
                    foo: bar
                    baz: quz
              inline:
                  sequence: &inline_sequence_anchor [ 8, 4, 2, ]
                  map:      &inline_map_anchor { foo: bar, baz: quz, }
              scalar: &scalar_anchor somestring
              
          aliases:
              block: 
                  sequence: *block_sequence_anchor
                  map: *block_map_anchor
              inline: 
                  sequence: *inline_sequence_anchor
                  map: *inline_map_anchor
              scalar: *scalar_anchor
              
          merge_keys:
              - <<: *block_map_anchor
              - << : *inline_map_anchor
          
          ENDYAML,
          
  ]);
  
it( 'throws exceptions when CUSTOM_PARSE_TAGS is required, but missing. ', );
it( 'parses yaml without resolving anchors, aliases, or merge keys. ', );
it( 'dumps yaml while preserving anchors, aliases, and merge keys. ', );
