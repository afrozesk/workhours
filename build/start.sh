if [[ "$currentFolder" != *build ]]
then
  # If current folder is not build then cd to build and docker root folder
  cd build
  cd docker
fi

docker-compose up --build --detach
