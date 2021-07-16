import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { environment } from '../environments/environment';

@Injectable()
export class BaseService {

  public baseUrl: string;

  constructor(public http: HttpClient) {
    this.baseUrl = environment.apiUrl;
  }

  getHeader(): any {

    const headerOptions = {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Accept': 'application/json'
    };

    return new HttpHeaders(headerOptions);
  }

}

