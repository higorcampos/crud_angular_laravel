import { Component,OnInit } from '@angular/core';
import { ListService } from '../services/list.service';
import { Router } from '@angular/router';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';

declare var $: any;
declare var swal: any;

import { Item } from './model/item';



@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [ListService]
})

export class AppComponent implements OnInit{

  listData: Array<Item>;
  ListDataEdit: any;
  formulario!: FormGroup;
  id!: number;
  index!: number;
  search: string = '';
  searchMsg: boolean = false;
  load: boolean = true;


  constructor(private _listService: ListService, private router: Router, private formBuilder: FormBuilder)
  {
    this.listData = [];
    this.ListDataEdit = [];
  }

  ngOnInit(): void {

    this.getAllList();

    this.formulario = this.formBuilder.group({
      name: [null,[Validators.required,Validators.minLength(3)]],
      email: [null,[Validators.required,Validators.email]]
    })


  }

  getAllList(): void {
    this.load = true;
    this._listService.getList()
      .subscribe(
        res => {
          this.listData = res.data;
          this.load = false;
          console.log(res)
        }
      )
  }

  editItem(idCliente: number, i: number): void {

    console.log('index',i);
    this.index = i;
    this._listService.getListData(idCliente)
      .subscribe(
        result => {
          this.formulario.setValue({
            name: result.data.name,
            email: result.data.email,

          });
          this.ListDataEdit = result.data;
          this.id = result.data.id;
          console.log(this.ListDataEdit);
          $("#edit").modal('show');
      }
    );

  }

  onSubmitUpdate(){

    this._listService.update(this.id,this.formulario.value).subscribe(
      result =>{
        $("#edit").modal('hide');
        this.listData[this.index].name = result.data.name;
        this.listData[this.index].email = result.data.email;
        this.formulario.reset();
      }
    )

  }

  onSubmit(){
    console.log(this.formulario)

    this._listService.save(this.formulario.value).subscribe(
      result =>{
        $("#save").modal('hide');
        this.listData.unshift(result.data);
        this.formulario.reset();
      }
    )

  }

  removeItem(id: any,i: number){
    this._listService.delete(id)
    .subscribe(res => {
      this.listData.splice(i, 1);
    });
  }


  openSave(){
    $("#save").modal('show');
  }


  find_list(term: any){
    this.load = true;
    if(term){
      this.searchMsg = false;
      this._listService.search(term)
        .subscribe(
          result => {
            this.listData = result.data;
            if(this.listData.length == 0){
              this.searchMsg = true;
            }
            this.load = false;

          }
      );

    }else{
      this.getAllList();
      this.searchMsg = false;
    }
  }


}
