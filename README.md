
# Unaliased YAML

A wrapper for the Symfony YAML component that allows parsing and dumping of YAML that ignores and preserves anchors, aliases, and merge keys. 

This allows users to parse YAML, manipulate the parsed tree of data, and then dump the result back to YAML without losing the aliasing features that have been placed there by the author of the original YAML. 
