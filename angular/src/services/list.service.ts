import {Injectable} from '@angular/core';
import {BaseService} from './base.service';
import {HttpHeaders} from '@angular/common/http';
import { from, Observable } from 'rxjs';

import { Item } from '../app/model/item'

@Injectable()
export class ListService extends BaseService {

  public getList(): Observable<{data: Item[]}> {
    return this.http.get<{data: Item[]}>(this.baseUrl + '/api/list', {headers: this.getHeader()});
  }


  public getListData(idCliente: number): Observable<any> {
    return this.http.get(this.baseUrl + '/api/list/'+idCliente+'/edit', {headers: this.getHeader()});
  }


  public update(id: number,data: any): Observable<any> {
    return this.http.post(this.baseUrl + '/api/list/update/' + id, data, this.getHeader());
  }


  public delete(params: number): Observable<any> {
    return this.http.delete(this.baseUrl + '/api/list/' +params, this.getHeader());
  }

  public save(data: any): Observable<any> {
    return this.http.post(this.baseUrl + '/api/list/', data, this.getHeader());
  }

  public search(term: string): Observable<{data: Item[]}> {
    return this.http.get<{data: Item[]}>(this.baseUrl + '/api/list/search/'+term, {headers: this.getHeader()});
  }


}
