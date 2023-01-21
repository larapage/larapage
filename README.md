# LaraPage

[![GitHub release](https://img.shields.io/github/release/larapage/larapage.svg)](https://github.com/larapage/larapage/releases/latest)
[![license](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/larapage/larapage/blob/development/LICENSE)
[![codecov](https://codecov.io/gh/larapage/larapage/branch/main/graph/badge.svg?token=4CYTVMVUYV)](https://codecov.io/gh/larapage/larapage)

LaraPage is a simple blog based on [Laravel](https://laravel.com) 9

## Features

- Publication and commenting of articles
- Heart likes
- Site search
- Public user profile
- User authentication
- Simple admin panel
- RESTful API with token authentication
- Localization

## Running the project locally

To run project LaraPage locally, you only need [Docker](https://www.docker.com). Further, we assume that you have already installed it.

Clone the repository:

```shell
git clone git@github.com:larapage/larapage.git && cd larapage
```

After that just run the command:

```shell
sail up -d
sail artisan migrate:fresh --seed
```

And open http://127.0.0.1 in your favorite browser. Happy using Secretic!

## Contributing

Do not hesitate to contribute to the project! Bug reports or pull requests are welcome. 

Just make an [issue](https://github.com/larapage/larapage/issues) or PR in current repository.

## License

This project is released under the [MIT](http://opensource.org/licenses/MIT) license.
