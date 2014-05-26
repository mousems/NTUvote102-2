##
# Middleman
##

set :source, "front-end-source"
set :build_dir, ".tmp"

class CopyAssets < Middleman::Extension
  def initialize(app, options_hash={}, &block)
    super
    app.after_build do
      system "cp -Rf #{root}/.tmp/css #{root}/"
      system "cp -Rf #{root}/.tmp/js #{root}/"
      # system "cp -Rf #{root}/.tmp/img #{root}/"
    end
  end
end

::Middleman::Extensions.register(:copy_assets, CopyAssets)

##
# Bower
##

@bower_config = JSON.parse(IO.read("#{root}/.bowerrc"))
ignore @bower_config["directory"].gsub(/front-end-source\//, "") + '/*'

###
# Compass
###

# Change Compass configuration
compass_config do |config|
  # Require additional compass plugins.
  config.add_import_path @bower_config["directory"].gsub(/front-end-source\//, "") + "/Han/sass"
  config.add_import_path @bower_config["directory"].gsub(/front-end-source\//, "") + "/foundation/scss"
  config.add_import_path @bower_config["directory"].gsub(/front-end-source\//, "") + "/susy/sass"
  # config.output_style = :compact
end

# Add bower's directory to sprockets asset path
sprockets.append_path File.join "#{root}", @bower_config["directory"]

set :css_dir, 'css'

set :js_dir, 'js'

set :images_dir, 'img'

# Build-specific configuration
configure :build do
  # For example, change the Compass output style for deployment
  activate :minify_css

  # Minify Javascript on build
  activate :minify_javascript

  # Enable cache buster
  # activate :asset_hash

  # Use relative URLs
  activate :relative_assets

  activate :copy_assets
end
